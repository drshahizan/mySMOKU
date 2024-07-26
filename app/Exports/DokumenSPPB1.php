<?php

namespace App\Exports;

use App\Models\Tuntutan;
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

class DokumenSPPB1 implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
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
        $senarai = Tuntutan::join('smoku as b', 'b.id', '=', 'tuntutan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'tuntutan.smoku_id')
            ->leftJoin('bk_jumlah_tuntutan as d', 'd.jenis', '=', DB::raw("'Yuran'"))
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->join('tuntutan_saringan as a', 'a.tuntutan_id','=','tuntutan.id')
            ->where('tuntutan.status', 6)
            ->whereNull('tuntutan.data_migrate')
            // ->where('tuntutan.data_migrate', '!=', '1')
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
                'tuntutan.yuran_disokong',
                'tuntutan.wang_saku_disokong',
                'tuntutan.baki',
                'a.catatan',    
                'tuntutan.yuran',    
                'tuntutan.wang_saku',    
            )
            ->get();
            
        // Add the calculated "jenis_permohonan" column to the collection
        $senarai = $senarai->map(function ($item, $key) {
            $jenis_permohonan = $this->calculateJenisPermohonan($item);
            $item['jenis_permohonan'] = $jenis_permohonan;

            // Add the "BIL" column directly using $key
            $item['bil'] = $key + 1;

            return $item;
        });
        // dd($senarai);
        return $senarai;
    }

    public function headings(): array
    {
        return [
            // Custom Rows
            ['INSTITUSI:'],
            ['NAMA PENERIMA:'],
            ['BANK:'],
            ['NO. AKAUN:'],
            ['(Sertakan salinan penyata akaun bank untuk rujukan pembayaran)***'], 
            [''],
            ['BORANG TUNTUTAN PERUNTUKAN PROGRAM BKOKU (SPBB 1)'], 

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
                'STATUS PENGAJIAN (AKTIF / TIDAK AKTIF)',
                'TAJAAN (SENDIRI / BIASISWA / PINJAMAN)',
                'MOD PENGAJIAN (SEPENUH MASA / SEPARUH MASA / JARAK JAUH / DALAM TALIAN)',
                'BILANGAN BULAN PER SEMESTER (4/6 BULAN)',
                'KOS SILING BKOKU (RM6,200 SETAHUN)',
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
        // Fetch sesi from Akademik table
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
            'B' => 30,           
            'C' => 20,
            'D' => 15,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 40,
            'I' => 20,
            'J' => 20,
            'K' => 21,
            'L' => 20,
            'M' => 12,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 30,
            'S' => 30,
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
             number_format((float)$row->baki, 2, '.', ''),
             $jenis_permohonan,
             strtoupper($row->catatan),
        ];
    }

    private function getInstitusiData()
    {
        return DB::table('bk_info_institusi')->where('id_institusi', $this->instiusi_user)->value('nama_institusi');
    }

    private function getNamaPenerimaData()
    {
        return DB::table('maklumat_bank')->where('institusi_id', Auth::user()->id_institusi)->value('nama_akaun');
    }

    private function getBankData()
    {
        return DB::table('maklumat_bank')->join('senarai_bank','senarai_bank.kod_bank','=','maklumat_bank.bank_id' )->where('institusi_id', Auth::user()->id_institusi)->value('senarai_bank.nama_bank');
    }

    private function getNoAkaunData()
    {
        return DB::table('maklumat_bank')->where('institusi_id', Auth::user()->id_institusi)->value('no_akaun');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Retrieve additional data for custom headers from the database
                $customHeaderData = [
                    ['INSTITUSI:', $this->getInstitusiData()], 
                    ['NAMA PENERIMA:', $this->getNamaPenerimaData()], 
                    ['BANK:', $this->getBankData()], 
                    ['NO. AKAUN:', $this->getNoAkaunData()], 
                    ['(Sertakan salinan penyata akaun bank untuk rujukan pembayaran)***'],
                    [''],
                    ['BORANG PERMOHONAN PERUNTUKAN PROGRAM BKOKU (SPBB 1)'],
                ];

                foreach ($customHeaderData as $index => $rowData) {
                    $rowNumber = $index + 1;
                    
                    foreach ($rowData as $columnIndex => $cellData) {
                        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex + 1);
                
                        // Merge cells for INSTITUSI, NAMA PENERIMA, BANK, and NO. AKAUN
                        if (in_array($cellData, ['INSTITUSI:', 'NAMA PENERIMA:', 'BANK:', 'NO. AKAUN:'])) {
                            // Merge cells and apply data
                            $event->sheet->mergeCells("{$columnLetter}{$rowNumber}:B{$rowNumber}");
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                            $event->sheet->setCellValue('C' . $rowNumber, $rowData[$columnIndex + 1]); // Add the data to the next column
                        } else {
                            // For other cells, just set the value
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                        }
                    }
                }

                // Get the row number where the table headers start
                $dataHeaderRow = 8; 

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
                ])
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setTextRotation(0) // Optional: Set text rotation to 0 degrees
                ->setWrapText(true);

                // Customize the style for the special rows
                $event->sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => 'FF0000'], // Red color
                        'italic' => true, // Italic font
                        'size' => 9,
                    ],
                ]);

                // Center the "BORANG PERMOHONAN PERUNTUKAN PROGRAM BKOKU" row and make it span all columns
                $event->sheet->mergeCells('A7:' . $event->sheet->getHighestColumn() . '7');
                $event->sheet->getStyle('A7')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                // Add borders and align to the data table
                $startRow = 7; 
                $startColumn = 'A';
                $endColumn = 'S'; 
                $endRow = $event->sheet->getHighestRow(); 

                $event->sheet->getStyle($startColumn . $startRow . ':' . $endColumn . $endRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Border color
                        ],
                    ],
                ])
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setTextRotation(0) // Optional: Set text rotation to 0 degrees
                ->setWrapText(true);

                // Specify the row indices to be bold
                $boldRows = [1, 2, 3, 4, 5];

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
                $event->sheet->setCellValue('A' . ($lastRow + 7), 'ii) Elaun Wang Saku RM400/ bulan');

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
                $event->sheet->setCellValue('O' . ($lastRow + 9), 'Disahkan oleh:');

                $event->sheet->getStyle('O' . ($lastRow + 10))->getFont()->setSize(9);
                $event->sheet->setCellValue('O' . ($lastRow + 10), 'Cop & tandatangan');

                $event->sheet->getStyle('O' . ($lastRow + 12))->getFont()->setSize(9);
                $event->sheet->setCellValue('O' . ($lastRow + 12), 'Tarikh:');

            },
        ];
    }
}
