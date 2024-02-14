<?php

namespace App\Exports;

use App\Models\Tuntutan;
use App\Models\Permohonan;
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

class DokumenSPBB3 implements WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $instiusi_user;
    private $counter = 0;
    private $totalBayaran  = 0;

    public function __construct()
    {
        // Get the institusi ID of the logged-in user
        $this->instiusi_user = Auth::user()->id_institusi;
    }

    // public function collection()
    // {
    //     // Fetch data from Tuntutan table
    //     $senaraiTuntutan = Tuntutan::join('smoku as b', 'b.id', '=', 'tuntutan.smoku_id')
    //         ->join('smoku_akademik as c', 'c.smoku_id', '=', 'tuntutan.smoku_id')
    //         ->leftJoin('bk_jumlah_tuntutan as d', 'd.jenis', '=', DB::raw("'Yuran'"))
    //         ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
    //         ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
    //         ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
    //         ->join('bk_mod as h','h.kod_mod','=','c.mod')
    //         ->join('tuntutan_saringan as a', 'a.tuntutan_id','=','tuntutan.id')
    //         ->where('tuntutan.status', 8) // Apply status condition to Tuntutan table
    //         ->where('d.jenis', 'Yuran')
    //         ->where('f.id_institusi', $this->instiusi_user)
    //         ->select(
    //             'b.id',
    //             'b.nama',
    //             'b.no_kp',
    //             'c.tarikh_mula',
    //             'c.tarikh_tamat',
    //             'c.nama_kursus',
    //             'c.status',
    //             DB::raw('COALESCE(d.jumlah, 0) as jumlah'),
    //             'tuntutan.yuran_dibayar',
    //             'tuntutan.wang_saku_dibayar',
    //             'tuntutan.no_baucer',
    //             'tuntutan.tarikh_transaksi',  
    //             'tuntutan.perihal',  
    //         );

    //     // Fetch data from Permohonan table
    //     $senaraiPermohonan = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
    //         ->join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
    //         ->leftJoin('bk_jumlah_tuntutan as d', 'd.jenis', '=', DB::raw("'Yuran'"))
    //         ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
    //         ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
    //         ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
    //         ->join('bk_mod as h','h.kod_mod','=','c.mod')
    //         ->where('permohonan.status', 8) // Apply status condition to Permohonan table
    //         ->where('d.jenis', 'Yuran')
    //         ->where('f.id_institusi', $this->instiusi_user)
    //         ->select(
    //             'b.id',
    //             'b.nama',
    //             'b.no_kp',
    //             'c.tarikh_mula',
    //             'c.tarikh_tamat',
    //             'c.nama_kursus',
    //             'c.status',
    //             DB::raw('COALESCE(d.jumlah, 0) as jumlah'),
    //             'permohonan.yuran_dibayar',
    //             'permohonan.wang_saku_dibayar',
    //             'permohonan.no_baucer',
    //             'permohonan.tarikh_transaksi',    
    //             'permohonan.perihal',    
    //         );

    //     // Combine the results of both queries
    //     $senarai = $senaraiTuntutan->union($senaraiPermohonan)->get();

    //     return $senarai;
    // }

    // public function headings(): array
    // {
    //     return [
    //         // Custom Rows
    //         ['INSTITUSI:'],
    //         ['CAWANGAN:'],
    //         ['BULAN:'],
    //         [''],
    //         ['LAPORAN PENYATA TERIMAAN DAN BAYARAN PROGRAM BKOKU'], 
    //         [''],

    //         // Section headers
    //         ['TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "TERIMAAN" section
    //         ['TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "BAYARAN" section
    //     ];
    // }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 5,
    //         'B' => 40,           
    //         'C' => 20,
    //         'D' => 30,
    //         'E' => 25,
    //         'F' => 15,
    //         'G' => 20,
    //         'H' => 20,
    //         'I' => 30,
    //         'J' => 20,
    //     ];
    // }

    // public function map($row): array
    // {
    //     // Retrive tarikh mula & tamat pengajian
    //     $tarikh_mula = Carbon::parse($row->tarikh_mula)->format('d/m/Y');
    //     $tarikh_tamat = Carbon::parse($row->tarikh_tamat)->format('d/m/Y');

    //     // Concatenate the formatted dates with the desired format
    //     $tempoh_tajaan = $tarikh_mula . ' - ' . $tarikh_tamat;

    //     // Calculate the total of yuran dibayar & want saki dibayar
    //     $bayaran = number_format($row->yuran_dibayar, 2, '.', '') + number_format($row->wang_saku_dibayar, 2, '.', '');

    //     // Checking for status
    //     if($row->status == 1)
    //         $status = 'AKTIF';
    //     else
    //         $status = 'TIDAK AKTIF';

    //     // Increment the counter for "BIL" column
    //     $this->counter++;

    //     // Update total values
    //     $this->totalBayaran += $bayaran;

    //     return [
    //          $this->counter,
    //          $row->nama,
    //          $row->no_kp,
    //          strtoupper($row->nama_kursus),
    //          $tempoh_tajaan,
    //          $status,
    //          number_format($bayaran, 2, '.', ''), 
    //          $row->no_baucer,
    //          strtoupper($row->perihal),
    //          Carbon::parse($row->tarikh_transaksi)->format('d/m/Y'),
    //     ];
    // }

    private function getInstitusiData()
    {
        // Assuming you retrieve the institution data from somewhere
        $institusiData = DB::table('bk_info_institusi')->where('id_institusi', $this->instiusi_user)->value('nama_institusi');
        
        // Convert the data to uppercase
        $institusiData = strtoupper($institusiData);

        return $institusiData;
    }

    private function getBulanData()
    {
        // Set the Carbon locale to Malay (Malaysia)
        Carbon::setLocale('ms');

        // Get the current month in Malay and the current year
        $currentMonth = Carbon::now()->translatedFormat('F');
        $currentYear = Carbon::now()->year;

        // Convert the month name to uppercase and concatenate with the year
        $currentMonth = strtoupper($currentMonth);
        $bulanTahun = $currentMonth . ' ' . $currentYear;

        return $bulanTahun;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Retrieve additional data for custom headers from the database
                $customHeaderData = [
                    ['', 'INSTITUSI:', $this->getInstitusiData()],
                    ['', 'CAWANGAN:'],
                    ['', 'BULAN:', $this->getBulanData()],
                    [''],
                    ['LAPORAN KUTIPAN BALIK BAGI PELAJAR BKOKU YANG TARIK DIRI/ BERHENTI'],
                ];

                foreach ($customHeaderData as $index => $rowData) {
                    $rowNumber = $index + 1;
                    
                    foreach ($rowData as $columnIndex => $cellData) {
                        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex + 1);

                        // Merge cells for custom headers
                        if (in_array($cellData, ['INSTITUSI:', 'CAWANGAN:', 'BULAN:'])) {
                            // Merge cells and apply data
                            $event->sheet->mergeCells("{$columnLetter}{$rowNumber}:C{$rowNumber}");
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                            // Check if the next column's data exists before accessing it
                            if (isset($rowData[$columnIndex + 1])) {
                                $event->sheet->mergeCells("{$columnLetter}{$rowNumber}:C{$rowNumber}");
                                $event->sheet->setCellValue('D' . $rowNumber, $rowData[$columnIndex + 1]);
                            }
                        } 
                        else {
                            // For other cells, just set the value
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                        }
                    }
                }

                // Set alignment and style for the entire header row
                $headerRange = 'B1:' . $event->sheet->getHighestColumn() . '3'; // Assuming the header row is from B1 to the last column in row 3
                $event->sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14, // Font size (14)
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // // Set alignment and style for the "LAPORAN KUTIPAN BALIK BAGI PELAJAR BKOKU YANG TARIK DIRI/ BERHENTI" row
                // $headerTittle = 'B5:' . $event->sheet->getHighestColumn() . '5';
                // $event->sheet->getStyle($headerTittle)->applyFromArray([
                //     'font' => [
                //         'bold' => true,
                //     ],
                //     'alignment' => [
                //         'horizontal' => Alignment::HORIZONTAL_CENTER,
                //     ],
                // ]);


                // Merge cells for "TERIMAAN" and "BAYARAN" sections
                $event->sheet->mergeCells('B7:E7'); // Merge "TERIMAAN" cells
                $event->sheet->mergeCells('F7:I7'); // Merge "BAYARAN" cells
    
                // Custom section headers
                $event->sheet->setCellValue('B7', 'TERIMAAN');
                $event->sheet->setCellValue('F7', 'BAYARAN');
    
                // Apply styles to the section headers
                $event->sheet->getStyle('B7:I7')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Background colour
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
    
                // Set column widths
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(25);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(15);
                $event->sheet->getColumnDimension('F')->setWidth(15);
                $event->sheet->getColumnDimension('G')->setWidth(25);
                $event->sheet->getColumnDimension('H')->setWidth(25);
                $event->sheet->getColumnDimension('I')->setWidth(15);

                // Custom section headers
                $event->sheet->setCellValue('B8', 'TARIKH');
                $event->sheet->setCellValue('C8', 'PERKARA');
                $event->sheet->setCellValue('D8', 'RUJUKAN');
                $event->sheet->setCellValue('E8', 'RM');
                $event->sheet->setCellValue('F8', 'TARIKH');
                $event->sheet->setCellValue('G8', 'PERKARA');
                $event->sheet->setCellValue('H8', 'RUJUKAN');
                $event->sheet->setCellValue('I8', 'RM');

                // Center-align section headers horizontally and vertically
                $event->sheet->getStyle('B7:I7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('B7:I7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // Apply styles to the section headers
                $event->sheet->getStyle('B8:I8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Background colour
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
            

                // Add borders and align to the data table
                $startRow = 8; 
                $startColumn = 'B';
                $endColumn = 'I'; 
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


                // Find the last row of the data
                $lastRow = $event->sheet->getHighestRow();

                // Format the total values with two decimal places
                $totalBayaranFormatted = number_format($this->totalBayaran , 2, '.', '');

                // Add a row at the end to display the total values
                $event->sheet->append([
                    ['', 'JUMLAH TERIMAAN (i)', '', $totalBayaranFormatted, '', 'JUMLAH BAYARAN (ii)', '', $totalBayaranFormatted],
                    ['','','','','','BAKI PERUNTUKAN [(iii) = (i) - (ii)]', $totalBayaranFormatted],
                    [''],
                    // Custom row for total
                    ['', 'JUMLAH (RM)', '', $totalBayaranFormatted, '', 'JUMLAH (RM)', '', $totalBayaranFormatted],
                ]);

                // Set the border for custom footer
                $event->sheet->getStyle('B' . ($lastRow + 1) . ':I' . ($lastRow + 3))->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11, 
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Corrected code set background for jumlah
                $event->sheet->getStyle('B' . ($lastRow + 4) . ':I' . ($lastRow + 4))->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], // Background colour
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


                $event->sheet->getStyle('B' . ($lastRow + 6))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 6), "* LAMPIRAN adalah maklumat lengkap bayaran seperti di Borang SPBB2");

                $event->sheet->getStyle('B' . ($lastRow + 7))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 7), "i)  Disahkan maklumat diatas adalah benar dan bayaran telah dibuat sewajarnya. ");

                $event->sheet->getStyle('B' . ($lastRow + 8))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 8), "ii) Disahkan telah menerima sejumlah peruntukan berjumlah RM64,885.00  dan wang tersebut telah direkodkan sebagai …Akaun Amanah/Akaun Peruntukan/ ");

                $event->sheet->getStyle('B' . ($lastRow + 9))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 9), "iii)Disahkan sehingga 31/12/2023  peruntukan telah berbaki RM 0.00");

                $event->sheet->getStyle('C' . ($lastRow + 11))->getFont()->setSize(10);
                $event->sheet->setCellValue('C' . ($lastRow + 11), 'Disediakan oleh:');

                $event->sheet->getStyle('C' . ($lastRow + 12))->getFont()->setSize(10);
                $event->sheet->setCellValue('C' . ($lastRow + 12), 'Cop & tandatangan');

                $event->sheet->getStyle('C' . ($lastRow + 14))->getFont()->setSize(10);
                $event->sheet->setCellValue('C' . ($lastRow + 14), 'Tarikh:');

                $event->sheet->getStyle('E' . ($lastRow + 11))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 11), 'Disemak oleh:');

                $event->sheet->getStyle('E' . ($lastRow + 12))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 12), 'Cop & tandatangan');

                $event->sheet->getStyle('E' . ($lastRow + 14))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 14), 'Tarikh:');

                $event->sheet->getStyle('H' . ($lastRow + 11))->getFont()->setSize(10);
                $event->sheet->setCellValue('H' . ($lastRow + 11), 'Disahkan oleh:');

                $event->sheet->getStyle('H' . ($lastRow + 12))->getFont()->setSize(10);
                $event->sheet->setCellValue('H' . ($lastRow + 12), 'Cop & tandatangan');

                $event->sheet->getStyle('H' . ($lastRow + 14))->getFont()->setSize(10);
                $event->sheet->setCellValue('H' . ($lastRow + 14), 'Tarikh:');
            },
        ];
    }
}
