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
                'yuran_dibayar' => isset($row['yuran_dibayar']) ? number_format($row['yuran_dibayar'], 2, '.', '') : null,
                'wang_saku_dibayar' => isset($row['wang_saku_dibayar']) ? number_format($row['wang_saku_dibayar'], 2, '.', '') : null,
                'no_baucer' => $row['no_baucer'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $this->convertExcelDate($row['tarikh_baucer']),
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
        // Get an array of unique 'no_rujukan_tuntutan' values from the modified data
        $noRujukanArray = collect($this->modifiedData)->pluck('no_rujukan_tuntutan')->unique()->toArray();

        // Update the 'status' column to 8 for the tuntutan records with matching 'no_rujukan_tuntutan'
        Tuntutan::whereIn('no_rujukan_tuntutan', $noRujukanArray)
            ->update(['status' => 8]);

        // Fetch the corresponding rows from tuntutan table
        $tuntutans = Tuntutan::whereIn('no_rujukan_tuntutan', $noRujukanArray)
        ->select('id', 'smoku_id')
        ->get();

        // Create new records in sejarah_tuntutan table based on the fetched rows
        foreach ($tuntutans as $tuntutan) {
            SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $tuntutan->smoku_id,
                'status' => 8
            ]);
        }
    }
}
