<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Tuntutan;
use App\Models\SejarahTuntutan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ModifiedTuntutanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $modifiedData = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Extract specific columns
            $tarikhBaucar = $row['tarikh_baucar'] ? $this->convertExcelDate($row['tarikh_baucar']) : null;

            $this->modifiedData[] = [
                'no_rujukan_tuntutan' => $row['id_tuntutan'],
                'yuran_dibayar' => number_format($row['yuran_dibayar_rm'], 2, '.', ''),
                'wang_saku_dibayar' => number_format($row['wang_saku_dibayar_rm'], 2, '.', ''),
                'no_baucer' => $row['no_baucar'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $tarikhBaucar,
                'status_pemohon' => $row['status_aktiftidak_aktif'],
            ];
        }
        // Update the 'status' column in the tuntutan table to 8
        $this->updateStatus();
    }

    public function getModifiedData()
    {
        return $this->modifiedData;
    }

    protected function convertExcelDate($excelDate)
    {
        // Convert Excel date to Carbon date
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate));
    }

    private function updateStatus()
    {
        // Determine the sesi bayaran based on the current date
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($currentMonth == 2) {
            $sesiBayaran = '1/' . $currentYear;
        } elseif ($currentMonth == 4) {
            $sesiBayaran = '2/' . $currentYear;
        } elseif ($currentMonth == 10) {
            $sesiBayaran = '3/' . $currentYear;
        } else {
            $sesiBayaran = '4/' . $currentYear;
        }

        foreach ($this->modifiedData as $modifiedRecord) {
            $noRujukan = $modifiedRecord['no_rujukan_tuntutan'];
            $yuranDibayar = $modifiedRecord['yuran_dibayar'];
            $wangSakuDibayar = $modifiedRecord['wang_saku_dibayar'];
            $noBaucer = $modifiedRecord['no_baucer'];
            $perihal = $modifiedRecord['perihal'];
            $tarikhBaucer = $modifiedRecord['tarikh_baucer'];
            $statusPemohon = $modifiedRecord['status_pemohon'];

            // Condition : yuran_dibayar and wang_saku_dibayar are not NULL and not equal to zero
            if ((!is_null($yuranDibayar) || $yuranDibayar != 0) && (!is_null($wangSakuDibayar) || $wangSakuDibayar != 0) && !is_null($noBaucer)) {
                $status = 8;
            } else {
                $status = 10;
            }

            // Update the fields for the tuntutan record that matching 'no_rujukan_tuntutan'
            Tuntutan::where('no_rujukan_tuntutan', $noRujukan)
                    ->update([
                        'status' => $status, 
                        'yuran_dibayar' => $yuranDibayar,
                        'wang_saku_dibayar' => $wangSakuDibayar,
                        'no_baucer' => $noBaucer,
                        'perihal' => $perihal,
                        'tarikh_baucer' => $tarikhBaucer,
                        'status_pemohon' => $statusPemohon,
                        'sesi_bayaran' => $sesiBayaran
                    ]);

            // Fetch the corresponding row from tuntutan table
            $tuntutan = Tuntutan::where('no_rujukan_tuntutan', $noRujukan)
                ->select('id', 'smoku_id')
                ->first();

            // Create a new record in sejarah_tuntutan table based on the fetched row
            if ($tuntutan) {
                SejarahTuntutan::create([
                    'tuntutan_id' => $tuntutan->id,
                    'smoku_id' => $tuntutan->smoku_id,
                    'status' => $status
                ]);
            }
        }
    }
}
