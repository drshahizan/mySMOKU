<?php

namespace App\Exports;

use App\Models\Akademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class Penyaluran implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $programCode;
    private $institusi;

    public function __construct($programCode, $institusi)
    {
        $this->programCode = $programCode;
        $this->institusi = $institusi;
    }

    public function collection()
    {
        $penyaluran = DB::table('permohonan as a')
            ->where('a.status', 8)
            ->where('a.program', $this->programCode);
            
        //dd($this->institusi);
        if (!empty($this->institusi)) {
            $penyaluran->where('c.nama_institusi', $this->institusi);
        }

        $penyaluran = $penyaluran
            ->select(
                'a.no_rujukan_permohonan', 
                'd.nama',
                'd.no_kp',
                'b.peringkat_pengajian',
                'a.no_baucer',
                'a.tarikh_baucer',
                'a.perihal',
                'a.no_cek',
                'a.tarikh_transaksi',
                'a.yuran_dibayar',
                'a.wang_saku_dibayar'
            )
            ->join('smoku_akademik as b', 'b.smoku_id', '=', 'a.smoku_id')
            ->join('bk_info_institusi as c', 'c.id_institusi', '=', 'b.id_institusi')
            ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
            ->join('bk_jenis_oku as e', 'e.kod_oku', '=', 'd.kategori')
            ->get();

        return collect($penyaluran);
    }

    public function headings(): array
    {
        return ["BIL","NAMA PELAJAR","NO. KAD PENGENALAN", "PERINGKAT", "URUSNIAGA", "CARA BAYAR",
         "NO BAUCER BYRN DI UA", "TARIKH BAUCER BYRN DI UA",
         "PERIHAL", "BANK", "NO CEK DI KPT", "TARIKH", "DEBIT"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 50,           
            'C' => 30,
            'D' => 20,
            'E' => 80,
            'F' => 60,
            'G' => 25,
            'H' => 30,
            'I' => 25,
            'J' => 25,
            'K' => 25,
            'L' => 25,
            'M' => 25,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '0',
        ];
    }

    private $bil;

    public function map($row): array
    {
        $this->bil = $this->bil ?? 1;
        return [
            // Update this to match with column name in database
            $this->bil++,  
            $row->nama,
            $row->no_kp,
            $row->peringkat_pengajian,
            11601,
            10,
            $row->no_baucer,
            \Carbon\Carbon::parse($row->tarikh_baucer)->format('d/m/Y'),
            $row->perihal,
            'BIMB',
            $row->no_cek,
            \Carbon\Carbon::parse($row->tarikh_transaksi)->format('d/m/Y'),
            $row->yuran_dibayar,
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
