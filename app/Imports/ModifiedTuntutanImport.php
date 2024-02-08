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
            $this->modifiedData[] = [
                'no_rujukan_tuntutan' => $row['id_tuntutan'],
                'yuran_dibayar' => number_format($row['yuran_dibayar_rm'], 2, '.', ''),
                'wang_saku_dibayar' => number_format($row['wang_saku_dibayar_rm'], 2, '.', ''),
                'no_baucer' => $row['no_baucar'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $this->convertExcelDate($row['tarikh_baucar']),
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
        foreach ($this->modifiedData as $modifiedRecord) {
            $noRujukan = $modifiedRecord['no_rujukan_tuntutan'];
            $yuranDibayar = $modifiedRecord['yuran_dibayar'];
            $wangSakuDibayar = $modifiedRecord['wang_saku_dibayar'];
            $noBaucer = $modifiedRecord['no_baucer'];
            $perihal = $modifiedRecord['perihal'];
            $tarikhBaucer = $modifiedRecord['tarikh_baucer'];

            // Check if the required attributes are filled
            if (!empty($yuranDibayar) && !empty($wangSakuDibayar) && !empty($noBaucer) && !empty($perihal) && !empty($tarikhBaucer)) {
                // Update the 'status' column to 8 for the tuntutan record with matching 'no_rujukan_tuntutan'
                Tuntutan::where('no_rujukan_tuntutan', $noRujukan)
                    ->update(['status' => 8]);

                // Fetch the corresponding row from tuntutan table
                $tuntutan = Tuntutan::where('no_rujukan_tuntutan', $noRujukan)
                    ->select('id', 'smoku_id')
                    ->first();

                // Create a new record in sejarah_tuntutan table based on the fetched row
                if ($tuntutan) {
                    SejarahTuntutan::create([
                        'tuntutan_id' => $tuntutan->id,
                        'smoku_id' => $tuntutan->smoku_id,
                        'status' => 8
                    ]);
                }
            }
        }
    }
}
