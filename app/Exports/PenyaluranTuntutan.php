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


class PenyaluranTuntutan implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
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
            
        // dd($penyaluran);
        if (!empty($this->institusi)) {
            $penyaluran->where('c.nama_institusi', $this->institusi);
        }

        $penyaluran = $penyaluran
        ->select(
            't.no_rujukan_tuntutan', 
            'd.nama',
            'd.no_kp',
            'p.kod_esp',
            't.no_baucer',
            't.tarikh_baucer',
            't.perihal',
            't.no_cek',
            't.tarikh_transaksi',
            't.yuran_dibayar',
            't.wang_saku_dibayar'
        )
        ->join('smoku_akademik as b', 'b.smoku_id', '=', 'a.smoku_id')
        ->join('bk_peringkat_pengajian as p', 'p.kod_peringkat', '=', 'b.peringkat_pengajian')
        ->join('bk_info_institusi as c', 'c.id_institusi', '=', 'b.id_institusi')
        ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
        ->join('bk_jenis_oku as e', 'e.kod_oku', '=', 'd.kategori')
        ->join('tuntutan as t', 't.permohonan_id', '=', 'a.id')
        ->get();

        // Assuming $penyaluran is the result of your original query
        $originalResults = $penyaluran;

        // Initialize an empty array to store the new rows
        $newRows = [];

        foreach ($originalResults as $originalRow) {
            // Check if 'yuran_dibayar' is not null
            if ($originalRow->yuran_dibayar !== null) {
                // Duplicate the original row for yuran
                $yuranRow = clone $originalRow;
                $yuranRow->debit = $originalRow->yuran_dibayar;
                $yuranRow->urusniaga = 11601; // Set urusniaga to 11601 for yuran
                unset($yuranRow->yuran_dibayar, $yuranRow->wang_saku_dibayar); // Remove yuran_dibayar and wang_saku_dibayar fields
                $newRows[] = $yuranRow;
            }

            // Check if 'wang_saku_dibayar' is not null
            if ($originalRow->wang_saku_dibayar !== null) {
                // Duplicate the original row for wang saku
                $wangSakuRow = clone $originalRow;
                $wangSakuRow->debit = $originalRow->wang_saku_dibayar;
                $wangSakuRow->urusniaga = 11912; // Set urusniaga to 11912 for wang_saku
                unset($wangSakuRow->yuran_dibayar, $wangSakuRow->wang_saku_dibayar); // Remove yuran_dibayar and wang_saku_dibayar fields
                $newRows[] = $wangSakuRow;
            }
        }


        // dd($newRows);    

        return collect($newRows);
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
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 25,
            'H' => 30,
            'I' => 30,
            'J' => 15,
            'K' => 20,
            'L' => 20,
            'M' => 20,
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
            $row->kod_esp,
            $row->urusniaga,
            10,
            $row->no_baucer,
            \Carbon\Carbon::parse($row->tarikh_baucer)->format('d-M-Y'),
            $row->perihal,
            'BIMB',
            $row->no_cek,
            \Carbon\Carbon::parse($row->tarikh_transaksi)->format('d-M-Y'),
            $row->debit,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Rename the sheet
                $event->sheet->setTitle('UA');
                
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
