<?php

namespace App\Exports;

use App\Models\Permohonan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermohonanLayakExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permohonan::all();
    }

    public function headings(): array
    {
        // Define column headings
        return [
            'ID Permohonan',
            'Nama',
            'Amaun Yuran',
            'Amaun Wang Saku',
            'Tarikh Permohonan',
        ];
    }
}
