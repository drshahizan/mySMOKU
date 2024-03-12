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
        } else{
            $sesiBayaran = '4/' . $currentYear;
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
            'tuntutan.tarikh_baucer',
            DB::raw('SUM(tuntutan.yuran_dibayar) as total_yuran_dibayar'),
            DB::raw('SUM(tuntutan.wang_saku_dibayar) as total_wang_saku_dibayar'),
            DB::raw('SUM(tuntutan.yuran_disokong) as total_yuran_disokong'),
            DB::raw('SUM(tuntutan.wang_saku_disokong) as total_wang_saku_disokong')
        )->groupBy('tuntutan.tarikh_transaksi', 'tuntutan.no_cek', 'tuntutan.tarikh_baucer');

        // Fetch data from Permohonan table
        $senaraiPermohonan = Permohonan::join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
        ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
        ->where('permohonan.status', 8) 
        ->where('permohonan.sesi_bayaran', $sesiBayaran)
        ->where('f.id_institusi', $this->instiusi_user)
        ->select(
            'permohonan.tarikh_transaksi',
            'permohonan.no_cek',
            'permohonan.tarikh_baucer',
            DB::raw('SUM(permohonan.yuran_dibayar) as total_yuran_dibayar'),
            DB::raw('SUM(permohonan.wang_saku_dibayar) as total_wang_saku_dibayar'),
            DB::raw('SUM(permohonan.yuran_disokong) as total_yuran_disokong'),
            DB::raw('SUM(permohonan.wang_saku_disokong) as total_wang_saku_disokong')
        )->groupBy('permohonan.tarikh_transaksi', 'permohonan.no_cek', 'permohonan.tarikh_baucer');


        // Execute the queries and get the results as collections
        $senaraiTuntutanResults = $senaraiTuntutan->get();
        $senaraiPermohonanResults = $senaraiPermohonan->get();

        // Now you can perform operations on the resulting collections
        $totalYuranDibayar = $senaraiPermohonanResults->sum('total_yuran_dibayar') + $senaraiTuntutanResults->sum('total_yuran_dibayar');
        $totalWangSakuDibayar = $senaraiPermohonanResults->sum('total_wang_saku_dibayar') + $senaraiTuntutanResults->sum('total_wang_saku_dibayar');
        $totalYuranDisokong = $senaraiPermohonanResults->sum('total_yuran_disokong') + $senaraiTuntutanResults->sum('total_yuran_disokong');
        $totalWangSakuDisokong = $senaraiPermohonanResults->sum('total_wang_saku_disokong') + $senaraiTuntutanResults->sum('total_wang_saku_disokong');

        // Calculate total bayaran and disokong
        $totalBayaran = number_format($totalYuranDibayar + $totalWangSakuDibayar, 2, '.', '');
        $totalDisokong = number_format($totalYuranDisokong + $totalWangSakuDisokong, 2, '.', '');

        // Merge the results of both queries into a single collection
        $senarai = $senaraiTuntutanResults->merge($senaraiPermohonanResults);

        $data = $senarai->map(function ($item) use ($totalBayaran, $totalDisokong) {
            return [
                'tarikh_transaksi' => $item->tarikh_transaksi,
                'no_cek' => $item->no_cek,
                'tarikh_baucer' => $item->tarikh_baucer,
                'total_bayaran' => $totalBayaran, 
                'total_disokong' => $totalDisokong, 
            ];
        });

        return $data;
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
            ['', 'TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "TERIMAAN" section
            ['', 'TARIKH', 'PERKARA', 'RUJUKAN', 'RM'], // Headers for the "BAYARAN" section
        ];
    }

    public function map($row): array
    {   
        //perkara
        $perkaraTerimaan = 'PERUNTUKAN DARIPADA BAHAGIAN BIASISWA';
        $perkaraBayaran = 'BAYARAN YURAN PENGAJIAN DAN ELAUN WANG SAKU SESI '. $this->getSesiBayaran();

        $this->totalBayaran = $row['total_bayaran'];
        $this->totalDisokong = $row['total_disokong'];
        
        // Prepare array elements
        return [
            '',
            Carbon::parse($row['tarikh_transaksi'])->format('d/m/Y'), 
            $perkaraTerimaan,
            $row['no_cek'], 
            number_format($row['total_disokong'], 2, '.', ''), 
            Carbon::parse($row['tarikh_baucer'])->format('d/m/Y'), 
            $perkaraBayaran,
            '',
            '', 
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

    private function getSesiBayaran()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Determine the sesi_bayaran based on the current month and year
        if ($currentMonth == 2) {
            $sesiBayaran = '1 ' . $currentYear . '/'. $currentYear+1;
        } elseif ($currentMonth == 4) {
            $sesiBayaran = '2 ' . $currentYear . '/'. $currentYear+1;
        } elseif ($currentMonth == 10) {
            $sesiBayaran = '3 ' . $currentYear . '/'. $currentYear+1;
        } else {
            $sesiBayaran = '4 ' . $currentYear . '/'. $currentYear+1;
        }

        return $sesiBayaran;
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
                    ['', 'LAPORAN PENYATA TERIMAAN DAN BAYARAN PROGRAM BKOKU BAGI SESI '. $this->getSesiBayaran()],
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
                        'size' => 14,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);


                // Retrieve additional data for tittle
                $customTittle = [
                    ['', 'LAPORAN PENYATA TERIMAAN DAN BAYARAN PROGRAM BKOKU BAGI SESI '. $this->getSesiBayaran()],
                ];

                foreach ($customTittle as $index => $rowData) 
                {
                    $rowNumber = $index + 5; // Adjust the row number to start from 5
                    $title = $rowData[1]; // Accessing the second element of the array
                    $event->sheet->mergeCells("B{$rowNumber}:I{$rowNumber}"); // Merge from column B to column I
                    $event->sheet->setCellValue("B{$rowNumber}", $title); // Set the title in column B
                }

                $event->sheet->getStyle('B5:I5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14, 
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
                $event->sheet->getColumnDimension('G')->setWidth(35);
                $event->sheet->getColumnDimension('H')->setWidth(15);
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

                $event->sheet->getStyle($startColumn . $startRow . ':' . $endColumn . $endRow+3)->applyFromArray([
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
                $baki = $totalDisokongFormatted - $totalBayaranFormatted;
                $bakiFormatted = number_format($baki , 2, '.', '');

                // Add a row at the end to display the total values
                $event->sheet->append([
                    ['', '', 'JUMLAH TERIMAAN (i)', '', $totalDisokongFormatted, 'JUMLAH BAYARAN (ii)', '', '', ''],
                    ['','','','','','BAKI PERUNTUKAN [(iii) = (i) - (ii)]', '', '', ''],
                    [''],
                    // Custom row for total
                    ['', '', 'JUMLAH (RM)', '', $totalDisokongFormatted, '', 'JUMLAH (RM)', '', ''],
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

                //get current date
                $currentDate =  Carbon::now()->format('d/m/Y');

                $event->sheet->getStyle('B' . ($lastRow + 6))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 6), "* LAMPIRAN adalah maklumat lengkap bayaran seperti di Borang SPBB2");

                $event->sheet->getStyle('B' . ($lastRow + 7))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 7), "i)  Disahkan maklumat diatas adalah benar dan bayaran telah dibuat sewajarnya. ");

                $event->sheet->getStyle('B' . ($lastRow + 8))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 8), "ii) Disahkan telah menerima sejumlah peruntukan berjumlah RM " . $totalDisokongFormatted . " dan wang tersebut telah direkodkan sebagai …Akaun Amanah/Akaun Peruntukan/ ");

                $event->sheet->getStyle('B' . ($lastRow + 9))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('B' . ($lastRow + 9), "iii)Disahkan sehingga ". $currentDate . " peruntukan telah berbaki RM " . $bakiFormatted);

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
