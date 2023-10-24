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
            // Update this to match with column name in database
            $row->no_rujukan_permohonan, 
            $row->nama,
            $row->no_pendaftaran_pelajar,
            $row->kecacatan,
            $row->nama_kursus,
            $row->nama_institusi,
            \Carbon\Carbon::parse($row->tarikh_mula)->format('d/m/Y'),
            \Carbon\Carbon::parse($row->tarikh_tamat)->format('d/m/Y'),
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
                        'color' => ['rgb' => 'FFFFFF'], // Header font color 
                        'size' => 12, // Header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '00094B'], // Header background color 
                    ],
                ]);
            },
        ];
    }
}
