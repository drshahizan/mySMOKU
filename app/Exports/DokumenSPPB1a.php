<?php

namespace App\Exports;

use App\Models\Permohonan;
use App\Models\Akademik;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DokumenSPPB1a implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $instiusi_user;
    private $counter = 0;

    public function __construct()
    {
        // Get the institusi ID of the logged-in user
        $this->instiusi_user = Auth::user()->id_institusi;
    }

    public function collection()
    {
        // Fetch data from the database based on the institusi ID
        $senarai = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
            ->leftJoin('bk_jumlah_tuntutan as d', 'd.jenis', '=', DB::raw("'Yuran'"))
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->where('permohonan.status', 6)
            ->where('d.jenis', 'Yuran')
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.no_pendaftaran_pelajar',
                'b.no_daftar_oku',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'g.peringkat',
                'c.status',
                'e.biaya',
                'h.mod',
                'c.bil_bulan_per_sem',
                DB::raw('COALESCE(d.jumlah, 0) as jumlah'),
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.baki',
                'permohonan.catatan_disokong',    
                'permohonan.yuran',    
                'permohonan.wang_saku',    
            )
            ->get();

        // Add the calculated "jenis_permohonan" column to the collection
        $senarai = $senarai->map(function ($item, $key) {
            $sesi = Akademik::where('smoku_id', $item['id'])->value('sesi');
            $jenis_permohonan = $this->calculateJenisPermohonan($item);
            $item['jenis_permohonan'] = $jenis_permohonan;

            // Add the "BIL" column directly using $key
            $item['bil'] = $key + 1;

            return $item;
        });
        
        return $senarai;
    }

    public function headings(): array
    {
        return [
            // Custom Rows
            ['INSTITUSI:'],
            ['CAWANGAN:'],
            ['NAMA PENERIMA:'],
            ['BANK:'],
            ['NO. AKAUN:'],

            // Data Headers
            array_map('strtoupper', [
                'BIL',
                'NAMA PELAJAR',
                'NO. KAD PENGENALAN',
                'NO KAD MATRIKS',
                'NO KAD JKM',
                'TARIKH MULA PENGAJIAN',
                'TARIKH TAMAT PENGAJIAN',
                'NAMA KURSUS',
                'PERINGKAT PENGAJIAN',
                'STATUS PENGAJIAN (AKTIF/TIDAK AKTIF)',
                'TAJAAN (SENDIRI/BIASISWA/PINJAMAN)',
                'MOD PENGAJIAN (SEPENUH MASA/SEPARUH MASA/JARAK JAUH/ DALAM TALIAN)',
                'BILANGAN BULAN PER SEMESTER (4/6 BULAN)',
                'KOS SILING BKOKU (RM5,000 SETAHUN)',
                'YURAN SEMESTER 1 (RM)',
                'ELAUN SEMESTER 1 (RM)',
                'BAKI KELAYAKAN (RM)',
                'JENIS TUNTUTAN',
                'CATATAN',
            ]),
        ];
    }

    private function calculateJenisPermohonan($item)
    {
         // Fetch sesi from SMOKUAkademik table
        $sesi = Akademik::where('smoku_id', $item['id'])->value('sesi');
 
        if ($item['yuran'] == 1 && $item['wang_saku'] == 1) {
            $result = 'YURAN PENGAJIAN DAN ELAUN WANG SAKU';
        } elseif ($item['yuran'] == 1) {
            $result = 'YURAN PENGAJIAN';
        } elseif ($item['wang_saku'] == 1) {
            $result = 'ELAUN WANG SAKU';
        } else {
            $result = 'Other';
        }
        
        return $result . ' SEM 1 DAN 2 TAHUN ' . $sesi;
        
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 50,           
            'C' => 20,
            'D' => 15,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 50,
            'I' => 20,
            'J' => 20,
            'K' => 35,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 35,
            'S' => 25,
        ];
    }

    public function map($row): array
    {
        // Calculate "jenis_permohonan" based on the fetched sesi
        $jenis_permohonan = $this->calculateJenisPermohonan($row);

        if($row->status == 1)
            $status = 'AKTIF';
        else
            $status = 'TIDAK AKTIF';

        // Increment the counter for "BIL" column
        $this->counter++;

        return [
             $this->counter,
             $row->nama,
             $row->no_kp,
             $row->no_pendaftaran_pelajar,
             $row->no_daftar_oku,
             Carbon::parse($row->tarikh_mula)->format('d/m/Y'),
             Carbon::parse($row->tarikh_tamat)->format('d/m/Y'),
             $row->nama_kursus,
             $row->peringkat_pengajian,
             $status,
             $row->biaya,
             $row->mod,
             $row->bil_bulan_per_sem,
             number_format($row->jumlah, 2, '.', ''), 
             number_format($row->yuran_disokong, 2, '.', ''), 
             number_format($row->wang_saku_disokong, 2, '.', ''), 
             number_format($row->baki, 2, '.', ''), 
             $jenis_permohonan,
             $row->catatan_disokong,
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
                        'color' => ['rgb' => '#000000'], // Header font color 
                        'size' => 12, // Header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'B3B3B3'], // Header background color 
                    ],
                ]);
            },
        ];
    }
}
