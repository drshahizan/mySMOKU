<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SenaraiPendekKeseluruhan implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    private $programCode;
    private $filters;

    public function __construct($programCode, $filters)
    {
        $this->programCode = $programCode;
        $this->filters = $filters;
    }

    public function collection()
    {
        return DB::table('permohonan as a')
            ->where('a.status', 4)
            ->join('smoku_akademik as b', function ($join) {
                $join->on('b.smoku_id', '=', 'a.smoku_id')
                    ->where('b.status', 1);
            })
            ->join('bk_info_institusi as c', function ($join) {
                $join->on('c.id_institusi', '=', 'b.id_institusi')
                    ->where('c.jenis_institusi', '!=', 'KI');
            })
            ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
            ->join('bk_jenis_oku as e', 'e.kod_oku', '=', 'd.kategori')
            ->when(!empty($this->filters['institusi']), function ($query) {
                return $query->where('c.id_institusi', $this->filters['institusi']);
            })
            ->select(
                'a.program',
                'a.no_rujukan_permohonan',
                'd.nama',
                'b.no_pendaftaran_pelajar',
                'e.kecacatan',
                'b.nama_kursus',
                'c.nama_institusi',
                'b.tarikh_mula',
                'b.tarikh_tamat'
            )
            ->orderBy('a.updated_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return ['Program', 'ID Permohonan', 'Nama Pemohon', 'No. Pendaftaran Pelajar', 'Jenis Kecacatan', 'Nama Kursus', 'Institusi Pengajian', 'Tarikh Mula Pengajian', 'Tarikh Tamat Pengajian'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 40,
            'D' => 30,
            'E' => 20,
            'F' => 40,
            'G' => 30,
            'H' => 15,
            'I' => 15,
        ];
    }

    public function map($row): array
    {
        return [
            strtoupper($row->program),
            $row->no_rujukan_permohonan,
            $row->nama,
            strtoupper($row->no_pendaftaran_pelajar),
            $row->kecacatan,
            $row->nama_kursus,
            $row->nama_institusi,
            $row->tarikh_mula ? \Carbon\Carbon::parse($row->tarikh_mula)->format('d/m/Y') : '',
            $row->tarikh_tamat ? \Carbon\Carbon::parse($row->tarikh_tamat)->format('d/m/Y') : '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '#000000'],
                        'size' => 11,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'B3B3B3'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);

                foreach ($event->sheet->getRowIterator(1) as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        $cell->setValue(strtoupper($cell->getValue()));
                    }
                }

                $event->sheet->getStyle('A2:I' . $event->sheet->getHighestRow())
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $event->sheet->getStyle('A2:I' . $event->sheet->getHighestRow())
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ],
                    ]);
            },
        ];
    }
}
