<?php

namespace App\Exports;

use App\Models\Permohonan;
use App\Models\Akademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class DokumenSPPB1a implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $instiusi_user;
    private $counter = 0;
    private $totalYuran = 0;
    private $totalWangSaku = 0;

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
            ['(Sertakan salinan penyata akaun bank untuk rujukan pembayaran)***'], 
            [''], // Add a blank row
            ['BORANG PERMOHONAN PERUNTUKAN PROGRAM BKOKU'], 

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
                'YURAN SEMESTER SEMASA (RM)',
                'ELAUN SEMESTER SEMASA (RM)',
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
            'A' => 3,
            'B' => 50,           
            'C' => 20,
            'D' => 15,
            'E' => 20,
            'F' => 25,
            'G' => 25,
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
            'R' => 50,
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

        // Update total values
        $this->totalYuran += $row->yuran_disokong;
        $this->totalWangSaku += $row->wang_saku_disokong;

        return [
             $this->counter,
             $row->nama,
             $row->no_kp,
             strtoupper($row->no_pendaftaran_pelajar),
             $row->no_daftar_oku,
             Carbon::parse($row->tarikh_mula)->format('d/m/Y'),
             Carbon::parse($row->tarikh_tamat)->format('d/m/Y'),
             strtoupper($row->nama_kursus),
             $row->peringkat,
             $status,
             $row->biaya,
             $row->mod,
             $row->bil_bulan_per_sem . ' BULAN',
             number_format($row->jumlah, 2, '.', ''), 
             number_format($row->yuran_disokong, 2, '.', ''), 
             number_format($row->wang_saku_disokong, 2, '.', ''), 
             number_format($row->baki, 2, '.', ''), 
             $jenis_permohonan,
             strtoupper($row->catatan_disokong),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Get the row number where the data headers start
                $dataHeaderRow = 9; // Change this to the appropriate row number

                // Customize the style of the data header row
                $event->sheet->getStyle('A' . $dataHeaderRow . ':' . $event->sheet->getHighestColumn() . $dataHeaderRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '#000000'], // Data header font color 
                        'size' => 11, // Data header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'B3B3B3'], // Data header background color 
                    ],
                ]);

                // Customize the style for the special rows
                $event->sheet->getStyle('A6')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => 'FF0000'], // Red color
                        'italic' => true, // Italic font
                        'size' => 9,
                    ],
                ]);

                // Center the "BORANG PERMOHONAN PERUNTUKAN PROGRAM BKOKU" row and make it span all columns
                $event->sheet->mergeCells('A8:' . $event->sheet->getHighestColumn() . '8');
                $event->sheet->getStyle('A8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                // Add borders to the data table
                $startRow = 8; // Set the starting row for borders
                $startColumn = 'A'; // Modify this based on your actual starting column
                $endColumn = 'S'; // Modify this based on your actual ending column
                $endRow = $event->sheet->getHighestRow(); // Get the last row dynamically

                $event->sheet->getStyle($startColumn . $startRow . ':' . $endColumn . $endRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Border color
                        ],
                    ],
                ]);

                // Specify the row indices to be bold
                $boldRows = [1, 2, 3, 4, 5, 6];

                // Bold the specified rows
                foreach ($boldRows as $rowIndex) {
                    $event->sheet->getStyle('A' . $rowIndex . ':' . $event->sheet->getHighestColumn() . $rowIndex)->getFont()->setBold(true);
                }

                // Find the last row of the data
                $lastRow = $event->sheet->getHighestRow();

                // Format the total values with two decimal places
                $totalYuranFormatted = number_format($this->totalYuran, 2, '.', '');
                $totalWangSakuFormatted = number_format($this->totalWangSaku, 2, '.', '');

                // Add a row at the end to display the total values
                $event->sheet->append([
                    // Custom row for total
                    ['JUMLAH', '', '', '', '', '', '', '', '', '', '', '', '','', $totalYuranFormatted, $totalWangSakuFormatted],
                ]);

                // Corrected code set background for jumlah
                $event->sheet->getStyle('A' . ($lastRow + 1) . ':S' . ($lastRow + 1))->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Choose your desired color
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 11, // Data header font size
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Border color
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A' . ($lastRow + 3))->getFont()->setSize(9);
                $event->sheet->setCellValue('A' . ($lastRow + 3), 'Disahkan data pelajar di atas adalah merupakan maklumat pelajar dalam senarai penawaran Program BKOKU yang diluluskan oleh Bahagian Biasiswa, Kementerian Pendidikan Tinggi.');

                $event->sheet->getStyle('A' . ($lastRow + 5))->getFont()->setSize(9);
                $event->sheet->setCellValue('A' . ($lastRow + 5), 'Catatan:');

                $event->sheet->getStyle('A' . ($lastRow + 6))->getFont()->setSize(9);
                $event->sheet->setCellValue('A' . ($lastRow + 6), 'i) Yuran mengikut semester');

                $event->sheet->getStyle('A' . ($lastRow + 7))->getFont()->setSize(9);
                $event->sheet->setCellValue('A' . ($lastRow + 7), 'ii) Elaun Wang Saku RM300/ bulan');

                $event->sheet->getStyle('B' . ($lastRow + 9))->getFont()->setSize(9);
                $event->sheet->setCellValue('B' . ($lastRow + 9), 'Disediakan oleh:');

                $event->sheet->getStyle('B' . ($lastRow + 10))->getFont()->setSize(9);
                $event->sheet->setCellValue('B' . ($lastRow + 10), 'Cop & tandatangan');

                $event->sheet->getStyle('B' . ($lastRow + 12))->getFont()->setSize(9);
                $event->sheet->setCellValue('B' . ($lastRow + 12), 'Tarikh:');

                $event->sheet->getStyle('K' . ($lastRow + 9))->getFont()->setSize(9);
                $event->sheet->setCellValue('K' . ($lastRow + 9), 'Disemak oleh:');

                $event->sheet->getStyle('K' . ($lastRow + 10))->getFont()->setSize(9);
                $event->sheet->setCellValue('K' . ($lastRow + 10), 'Cop & tandatangan');

                $event->sheet->getStyle('K' . ($lastRow + 12))->getFont()->setSize(9);
                $event->sheet->setCellValue('K' . ($lastRow + 12), 'Tarikh:');

                $event->sheet->getStyle('O' . ($lastRow + 9))->getFont()->setSize(9);
                $event->sheet->setCellValue('O' . ($lastRow + 9), 'Disemak oleh:');

                $event->sheet->getStyle('O' . ($lastRow + 10))->getFont()->setSize(9);
                $event->sheet->setCellValue('O' . ($lastRow + 10), 'Cop & tandatangan');

                $event->sheet->getStyle('O' . ($lastRow + 12))->getFont()->setSize(9);
                $event->sheet->setCellValue('O' . ($lastRow + 12), 'Tarikh:');
            },
        ];
    }
}