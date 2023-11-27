<?php

namespace App\Imports;

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
            // Extract specific columns
            $this->modifiedData[] = [
                'no_rujukan_permohonan' => $row['id_permohonan'],
                'yuran_dibayar' => number_format($row['yuran_dibayar'], 2, '.', ''),
                'wang_saku_dibayar' => number_format($row['wang_saku_dibayar'], 2, '.', ''),
                'no_baucer' => $row['no_baucer'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $this->convertExcelDate($row['tarikh_baucer']),
            ];
        }
    }

    protected function convertExcelDate($excelDate)
    {
        // Convert Excel date to Carbon date
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate));
    }

    public function getModifiedData()
    {
        return $this->modifiedData;
    }
}
