<?php

namespace App\Exports;

use App\Models\Permohonan;
use App\Models\TuntutanPermohonan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SenaraiPendek implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TuntutanPermohonan::select("id_permohonan","nokp_pelajar","program","amaun")->get();
    }

    public function headings(): array
    {
        return ["ID Permohonan", "No. Kad Pengenalan", "Program", "Amaun Diluluskan(RM)"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,           
            'C' => 15,
            'D' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
