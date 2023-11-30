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
            // dd($row);
            // Extract specific columns
            $this->modifiedData[] = [
                'no_rujukan_permohonan' => $row['id_permohonan'],
                'yuran_dibayar' => number_format($row['yuran_dibayar_rm'], 2, '.', ''),
                'wang_saku_dibayar' => number_format($row['wang_saku_dibayar_rm'], 2, '.', ''),
                'no_baucer' => $row['no_baucer'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $this->convertExcelDate($row['tarikh_baucer']),
            ];
        }
        // Update the 'status' column in the permohonan table to 8
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
        // Get an array of unique 'no_rujukan_permohonan' values from the modified data
        $noRujukanArray = collect($this->modifiedData)->pluck('no_rujukan_permohonan')->unique()->toArray();

        // Update the 'status' column to 8 for the permohonan records with matching 'no_rujukan_permohonan'
        Permohonan::whereIn('no_rujukan_permohonan', $noRujukanArray)
            ->update(['status' => 8]);

        // Fetch the corresponding rows from permohonan table
        $permohonans = Permohonan::whereIn('no_rujukan_permohonan', $noRujukanArray)
        ->select('id', 'smoku_id')
        ->get();

        // Create new records in sejarah_permohonan table based on the fetched rows
        foreach ($permohonans as $permohonan) {
            SejarahPermohonan::create([
                'permohonan_id' => $permohonan->id,
                'smoku_id' => $permohonan->smoku_id,
                'status' => 8
            ]);
        }
    }
}
