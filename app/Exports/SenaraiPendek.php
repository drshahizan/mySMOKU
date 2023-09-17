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
        ->select('a.no_rujukan_permohonan', 'd.nama', 'b.no_pendaftaran_pelajar', 'e.kecacatan', 'b.nama_kursus', 'c.nama_institusi', 'b.tarikh_mula', 'b.tarikh_tamat')
        ->join('smoku_akademik as b', 'b.smoku_id', '=', 'a.smoku_id')
        ->join('bk_info_institusi as c', 'c.id_institusi', '=', 'b.id_institusi')
        ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
        ->join('bk_jenis_oku as e', 'e.kod_oku', '=', 'd.kategori')
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
