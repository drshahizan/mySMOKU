<?php

namespace App\Exports;

use App\Models\Akademik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SenaraiPendek implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Akademik::select("no_pendaftaranpelajar","nokp_pelajar","peringkat_pengajian","nama_kursus","tkh_mula","tkh_tamat")->get();
    }

    public function headings(): array
    {
        return ["No. Pendaftaran Pelajar", "No. Kad Pengenalan", "Peringkat Pengajian", "Nama Kursus", "Tarikh Mula Pengajian", "Tarikh Tamat Pengajian"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 25,           
            'C' => 20,
            'D' => 60,
            'E' => 20,
            'F' => 25,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '0',
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
