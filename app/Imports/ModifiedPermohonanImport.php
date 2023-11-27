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
            // Extract specific columns
            $this->modifiedData[] = [
                'yuran_dibayar' => $row['Yuran Dibayar'],
                'wang_saku_dibayar' => $row['Wang Saku Dibayar'],
                'no_baucer' => $row['No Baucer'],
                'perihal' => $row['Perihal'],
                'tarikh_baucer' => $row['Tarikh Baucer'],
            ];
        }
    }

    public function getModifiedData()
    {
        return $this->modifiedData;
    }
}
