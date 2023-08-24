<?php

namespace App\Exports;

use App\Models\Akademik;
use Illuminate\Support\Facades\DB;
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
        $akademik = DB::select("SELECT b.nama_pelajar, a.no_pendaftaranpelajar, a.nokp_pelajar, a.peringkat_pengajian, a.nama_kursus, a.tkh_mula, a.tkh_tamat  
        FROM maklumatakademik a 
        INNER JOIN pelajar b ON b.nokp_pelajar = a.nokp_pelajar ");
        return collect($akademik);
    }

    public function headings(): array
    {
        return ["Nama Pemohon","No. Pendaftaran Pelajar", "No. Kad Pengenalan", "Peringkat Pengajian", "Nama Kursus", "Tarikh Mula Pengajian", "Tarikh Tamat Pengajian"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 50,
            'B' => 25,           
            'C' => 20,
            'D' => 20,
            'E' => 80,
            'F' => 25,
            'G' => 25,
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
