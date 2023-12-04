<?php

namespace App\Exports;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class DokumenSPPB1a implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $dateFormat = 'd/m/Y';

    public function collection()
    {
        // Get the institusi ID of the logged-in user
        $instiusi_user = Auth::user()->id_institusi;

        // Fetch data from the database based on the institusi ID
        $senarai = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('permohonan.status', 6)
            ->where('bk_info_institusi.id_institusi', $instiusi_user)
            ->select(
                'permohonan.no_rujukan_permohonan',
                'b.nama',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.tarikh_hantar'
            )
            ->get();
        
        return $senarai;
    }

    public function headings(): array
    {
        // Define column headings
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
                'JENIS PERMOHONAN',
                'CATATAN',
            ]),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 50,           
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 15,
            'P' => 15,
            'Q' => 15,
            'R' => 25,
            'S' => 25,
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
             Carbon::parse($row->tarikh_mula)->format('d/m/Y'),
             Carbon::parse($row->tarikh_tamat)->format('d/m/Y'),
            number_format($row->yuran_disokong, 2, '.', ''), // Format 'Yuran Disokong' as numeric with two decimal places
            number_format($row->wang_saku_disokong, 2, '.', ''), // Format 'Wang Saku Disokong' as numeric with two decimal places
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
