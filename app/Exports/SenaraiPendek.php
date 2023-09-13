<?php

namespace App\Exports;

use App\Models\Akademik;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class SenaraiPendek implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $senarai_pendek = DB::table('permohonan as a')
        ->where('a.status', 4)
        ->select('a.id_permohonan', 'd.nama_pelajar', 'b.no_pendaftaranpelajar', 'e.kecacatan', 'b.nama_kursus', 'c.namaipt', 'b.tkh_mula', 'b.tkh_tamat')
        ->join('maklumatakademik as b', 'b.nokp_pelajar', '=', 'a.nokp_pelajar')
        ->join('bk_infoipt as c', 'c.idipt', '=', 'b.id_institusi')
        ->join('pelajar as d', 'd.nokp_pelajar', '=', 'a.nokp_pelajar')
        ->join('bk_jenisoku as e', 'e.kodoku', '=', 'd.kecacatan')
        ->get();

        return collect($senarai_pendek);
    }

    public function headings(): array
    {
        return ["ID Permohonan","Nama Pemohon","No. Pendaftaran Pelajar", "Jenis Kecacatan", "Nama Kursus", "Institusi Pengajian", "Tarikh Mula Pengajian", "Tarikh Tamat Pengajian"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 50,           
            'C' => 30,
            'D' => 20,
            'E' => 80,
            'F' => 60,
            'G' => 25,
            'H' => 25,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '0',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id_permohonan,
            $row->nama_pelajar,
            $row->no_pendaftaranpelajar,
            $row->kecacatan,
            $row->nama_kursus,
            $row->namaipt,
            \Carbon\Carbon::parse($row->tkh_mula)->format('d/m/Y'),
            \Carbon\Carbon::parse($row->tkh_tamat)->format('d/m/Y'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Customize the style of the header row
                $event->sheet->getStyle('A1:' . $event->sheet->getHighestColumn() . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'], // Header font color 
                        'size' => 12, // Header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'ADD8E6'], // Header background color 
                    ],
                ]);
            },
        ];
    }
}
