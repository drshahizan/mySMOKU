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

class DokumenSPBB3 implements FromCollection, WithHeadings, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $instiusi_user;
    private $totalBayaran = 0;
    private $totalDisokong = 0;

    public function __construct()
    {
        // Get the institusi ID of the logged-in user
        $this->instiusi_user = Auth::user()->id_institusi;
    }

    public function collection()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Determine the sesi_bayaran based on the current month and year
        if ($currentMonth == 2) {
            $sesiBayaran = '1/' . $currentYear;
        } elseif ($currentMonth == 4) {
            $sesiBayaran = '2/' . $currentYear;
        } elseif ($currentMonth == 10) {
            $sesiBayaran = '3/' . $currentYear;
        }

        // Fetch data from Tuntutan table
        $senaraiTuntutan = Tuntutan::join('smoku_akademik as c', 'c.smoku_id', '=', 'tuntutan.smoku_id')
                            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
                            ->where('tuntutan.status', 8)
                            ->where('tuntutan.sesi_bayaran', $sesiBayaran)
                            ->where('f.id_institusi', $this->instiusi_user)
                            ->select(
                                'tuntutan.tarikh_transaksi',
                                'tuntutan.no_cek',
                                'tuntutan.yuran_disokong',
                                'tuntutan.wang_saku_disokong',
                                'tuntutan.tarikh_baucer',
                                'tuntutan.perihal',
                                'tuntutan.no_baucer',
                                'tuntutan.yuran_dibayar',
                                'tuntutan.wang_saku_dibayar',
                            )
                            ->groupBy('tuntutan.smoku_id', 'tuntutan.tarikh_transaksi', 'tuntutan.no_cek', 'tuntutan.yuran_disokong', 'tuntutan.wang_saku_disokong', 
                            'tuntutan.tarikh_baucer', 'tuntutan.perihal', 'tuntutan.no_baucer',  'tuntutan.yuran_dibayar', 'tuntutan.wang_saku_dibayar');

        // Fetch data from Permohonan table
        $senaraiPermohonan = Permohonan::join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
                            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
                            ->where('permohonan.status', 8) 
                            ->where('permohonan.sesi_bayaran', $sesiBayaran)
                            ->where('f.id_institusi', $this->instiusi_user)
                            ->select(
                                'permohonan.tarikh_transaksi',
                                'permohonan.catatan_disokong', 
                                'permohonan.no_cek',
                                'permohonan.yuran_disokong',
                                'permohonan.wang_saku_disokong',
                                'permohonan.tarikh_baucer',
                                'permohonan.perihal',
                                'permohonan.no_baucer',
                                'permohonan.yuran_dibayar',
                                'permohonan.wang_saku_dibayar',
                            )
                            ->groupBy('permohonan.smoku_id', 'permohonan.tarikh_transaksi', 'permohonan.catatan_disokong', 'permohonan.no_cek', 'permohonan.yuran_disokong', 'permohonan.wang_saku_disokong',
                            'permohonan.tarikh_baucer', 'permohonan.perihal', 'permohonan.no_baucer', 'permohonan.yuran_dibayar', 'permohonan.wang_saku_dibayar',);

        // Combine the results of both queries
        $senarai = $senaraiTuntutan->union($senaraiPermohonan)->get();

        return $senarai;
    }

    public function headings(): array
    {
        return [
            // Custom Rows
            ['INSTITUSI:'],
            ['CAWANGAN:'],
            ['BULAN:'],
            [''],
            ['LAPORAN PENYATA TERIMAAN DAN BAYARAN PROGRAM BKOKU'], 
            [''],

            // Section headers
            ['TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "TERIMAAN" section
            ['TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "BAYARAN" section
        ];
    }

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

    public function map($row): array
    {
        // Calculate the total of yuran dibayar & want saki dibayar
        $dibayar = number_format($row->yuran_dibayar, 2, '.', '') + number_format($row->wang_saku_dibayar, 2, '.', '');
        $disokong = number_format($row->yuran_disokong, 2, '.', '') + number_format($row->wang_saku_disokong, 2, '.', '');

        // Update total values
        $this->totalBayaran += $dibayar;
        $this->totalDisokong += $disokong;

        return [
             Carbon::parse($row->tarikh_transaksi)->format('d/m/Y'),
             strtoupper($row->catatan_disokong),
             $row->no_cek,
             number_format($disokong, 2, '.', ''), 
             Carbon::parse($row->tarikh_baucer)->format('d/m/Y'),
             strtoupper($row->perihal),
             $row->no_baucer,
             number_format($dibayar, 2, '.', ''), 
        ];
    }

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
                    ['LAPORAN PENYATA TERIMAAN DAN BAYARAN PROGRAM BKOKU'],
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
                $totalDisokongFormatted = number_format($this->totalDisokong , 2, '.', '');

                // Add a row at the end to display the total values
                $event->sheet->append([
                    ['', 'JUMLAH TERIMAAN (i)', '', $totalBayaranFormatted, '', 'JUMLAH BAYARAN (ii)', '', $totalBayaranFormatted],
                    ['','','','','','BAKI PERUNTUKAN [(iii) = (i) - (ii)]', $totalBayaranFormatted],
                    [''],
                    // Custom row for total
                    ['', 'JUMLAH (RM)', '', $totalDisokongFormatted, '', 'JUMLAH (RM)', '', $totalBayaranFormatted],
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
