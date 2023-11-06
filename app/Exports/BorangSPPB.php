<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BorangSPPB implements FromCollection,  WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $programCode;
    private $filters;

    public function __construct($programCode, $filters)
    {
        $this->programCode = $programCode;
        $this->filters = $filters;
    }

    public function collection()
    {
        $senarai_pendek = DB::table('permohonan as a')
            ->where('a.status', 4)
            ->where('a.program', $this->programCode);

        if (isset($this->filters['institusi'])) {
            $senarai_pendek->where('c.id_institusi', $this->filters['institusi']);
        }

        // Add a condition to check if jenis_institusi is 'UA'
        $senarai_pendek->join('smoku_akademik as b', 'b.smoku_id', '=', 'a.smoku_id')
            ->join('bk_info_institusi as c', 'c.id_institusi', '=', 'b.id_institusi')
            ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
            ->join('bk_jenis_oku as e', 'e.kod_oku', '=', 'd.kategori')
            ->where('c.jenis_institusi', 'UA');

        $senarai_pendek = $senarai_pendek
            ->select(
                'a.no_rujukan_permohonan', 
                'd.nama',
                'b.no_pendaftaran_pelajar',
                'e.kecacatan',
                'b.nama_kursus',
                'c.nama_institusi',
                'b.tarikh_mula',
                'b.tarikh_tamat'
            )
            ->get();

        return collect($senarai_pendek);
    }

    public function headings(): array
    {
        return [
            // Custom Rows
            ['INSTITUSI:', strtoupper($this->filters['institusi'] ?? '')],
            ['CAWANGAN:'],
            ['NAMA PENERIMA:'],
            ['BANK:'],
            ['NO. AKAUN:'],
            // Data Headers
            array_map('strtoupper', ["ID Permohonan", "Nama Pemohon", "No. Pendaftaran Pelajar", "Jenis Kecacatan", "Nama Kursus", "Institusi Pengajian", "Tarikh Mula Pengajian", "Tarikh Tamat Pengajian"]),
        ];
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
            'ID Permohonan' => $row->no_rujukan_permohonan,
            'Nama Pemohon' => mb_convert_case($row->nama, MB_CASE_TITLE, 'UTF-8'),
            'No. Pendaftaran Pelajar' => strtoupper($row->no_pendaftaran_pelajar),
            'Jenis Kecacatan' => mb_convert_case($row->kecacatan, MB_CASE_TITLE, 'UTF-8'),
            'Nama Kursus' => $row->nama_kursus,
            'Institusi Pengajian' => $row->nama_institusi,
            'Tarikh Mula Pengajian' => \Carbon\Carbon::parse($row->tarikh_mula)->format('d/m/Y'),
            'Tarikh Tamat Pengajian' => \Carbon\Carbon::parse($row->tarikh_tamat)->format('d/m/Y'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Customize the style of the header row
                $event->sheet->getStyle('A6:' . $event->sheet->getHighestColumn() . '6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // Header font color 
                        'size' => 11, // Header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '808080'], // Header background color (gray)
                    ],
                ]);

                // Merge the user input cells (spanning one row and seven columns)
                $this->mergeCells($event, 'B1:H1'); // For user input (Institusi)
                $this->mergeCells($event, 'B2:H2'); // For user input (Cawangan)
                $this->mergeCells($event, 'B3:H3'); // For user input (Nama Penerima)
                $this->mergeCells($event, 'B4:H4'); // For user input (Bank)
                $this->mergeCells($event, 'B5:H5'); // For user input (No. Akaun)

                // Add borders to the custom header
                $this->addBordersToCustomHeader($event);

                // Insert a blank row as a separator
                $event->sheet->insertNewRowBefore(6, 1);
            },
        ];
    }

    private function mergeCells(AfterSheet $event, $cellRange)
    {
        $event->sheet->mergeCells($cellRange);
        
        // Add borders to the merged cells
        $event->sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
    }

    private function addBordersToCustomHeader(AfterSheet $event)
    {
        $event->sheet->getStyle('A1:H5')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
    }
}
