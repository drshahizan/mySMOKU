<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
                'yuran_dibayar' => $row['yuran_dibayar'],
                'wang_saku_dibayar' => $row['wang_saku_dibayar'],
                'no_baucer' => $row['no_baucer'],
                'perihal' => $row['perihal'],
                'tarikh_baucer' => $row['tarikh_baucer'],
            ];
        }
    }

    public function getModifiedData()
    {
        return $this->modifiedData;
    }
}
