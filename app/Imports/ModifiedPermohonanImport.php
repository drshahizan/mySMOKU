<?php

namespace App\Imports;

use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class ModifiedPermohonanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $modifiedData = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->modifiedData[] = [
                'no_rujukan_permohonan' => $row['id_permohonan'],
                'yuran_dibayar' => number_format($row['yuran_dibayar_rm'], 2, '.', ''),
                'wang_saku_dibayar' => number_format($row['wang_saku_dibayar_rm'], 2, '.', ''),
                'no_baucer' => $row['no_baucar'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $this->convertExcelDate($row['tarikh_baucar']),
                'status_pemohon' => $row['status_aktiftidak_aktif'],
            ];
        }
        // Go to private function to update the 'status' column in the permohonan table to 8
        $this->updateStatus();
    }

    public function getModifiedData()
    {
        return $this->modifiedData;
    }

    protected function convertExcelDate($excelDate)
    {
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
            $noRujukan = $modifiedRecord['no_rujukan_permohonan'];
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

            // Update the fields for the permohonan record with matching 'no_rujukan_permohonan'
            Permohonan::where('no_rujukan_permohonan', $noRujukan)
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

            // Fetch the corresponding row from permohonan table
            $permohonan = Permohonan::where('no_rujukan_permohonan', $noRujukan)
                ->select('id', 'smoku_id')
                ->first();

            // Create a new record in sejarah_permohonan table based on the fetched row
            if ($permohonan) {
                SejarahPermohonan::create([
                    'permohonan_id' => $permohonan->id,
                    'smoku_id' => $permohonan->smoku_id,
                    'status' => $status
                ]);
            }
        }
    }

    // private function updateStatus()
    // {
    //     foreach ($this->modifiedData as $modifiedRecord) {
    //         $noRujukan = $modifiedRecord['no_rujukan_permohonan'];
    //         $yuranDibayar = $modifiedRecord['yuran_dibayar'];
    //         $wangSakuDibayar = $modifiedRecord['wang_saku_dibayar'];
    //         $noBaucer = $modifiedRecord['no_baucer'];
    //         $perihal = $modifiedRecord['perihal'];
    //         $tarikhBaucer = $modifiedRecord['tarikh_baucer'];
    //         $statusPemohon = $modifiedRecord['status_pemohon'];

    //         // Check if the required attributes are filled
    //         if (!empty($yuranDibayar) && !empty($wangSakuDibayar) && !empty($noBaucer) && !empty($perihal) && !empty($tarikhBaucer)) 
    //         {
    //             // Update the fields for the permohonan record with matching 'no_rujukan_permohonan'
    //             Permohonan::where('no_rujukan_permohonan', $noRujukan)
    //                         ->update([
    //                             'status' => 8, 
    //                             'yuran_dibayar' => $yuranDibayar,
    //                             'wang_saku_dibayar' => $wangSakuDibayar,
    //                             'no_baucer' => $noBaucer,
    //                             'perihal' => $perihal,
    //                             'tarikh_baucer' => $tarikhBaucer,
    //                             'status_pemohon' => $statusPemohon
    //                         ]);

    //             // Fetch the corresponding row from permohonan table
    //             $permohonan = Permohonan::where('no_rujukan_permohonan', $noRujukan)
    //                 ->select('id', 'smoku_id')
    //                 ->first();

    //             // Create a new record in sejarah_permohonan table based on the fetched row
    //             if ($permohonan) {
    //                 SejarahPermohonan::create([
    //                     'permohonan_id' => $permohonan->id,
    //                     'smoku_id' => $permohonan->smoku_id,
    //                     'status' => 8
    //                 ]);
    //             }
    //         }
    //     }
    // }
}
