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

class DokumenSPBB2 implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
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
            ->where('tuntutan.status', 8)
            ->where('d.jenis', 'Yuran')
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'c.status',
                DB::raw('COALESCE(d.jumlah, 0) as jumlah'),
                'tuntutan.yuran_dibayar',
                'tuntutan.wang_saku_dibayar',
                'tuntutan.no_baucer',
                'tuntutan.tarikh_transaksi',  
                'tuntutan.perihal',  
            )
            ->get();

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
            ['LAPORAN BAYARAN PROGRAM BKOKU (SPBB 2)'], 

            // Data Headers
            array_map('strtoupper', [
                'BIL',
                'NAMA PELAJAR',
                'NO. KAD PENGENALAN',
                'NAMA KURSUS',
                'TEMPOH TAJAAN',                
                'STATUS',
                'BAYARAN (RM)',
                'RUJUKAN BAYARAN',
                'JENIS TUNTUTAN',
                'RUJUKAN PTB SPBB3',
            ]),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,           
            'C' => 20,
            'D' => 40,
            'E' => 25,
            'F' => 15,
            'G' => 20,
            'H' => 20,
            'I' => 30,
            'J' => 20,
        ];
    }

    public function map($row): array
    {
        // Retrive tarikh mula & tamat pengajian
        $tarikh_mula = Carbon::parse($row->tarikh_mula)->format('d/m/Y');
        $tarikh_tamat = Carbon::parse($row->tarikh_tamat)->format('d/m/Y');

        // Concatenate the formatted dates with the desired format
        $tempoh_tajaan = $tarikh_mula . ' - ' . $tarikh_tamat;

        // Calculate the total of yuran dibayar & want saki dibayar
        $bayaran = number_format($row->yuran_dibayar, 2, '.', '') + number_format($row->wang_saku_dibayar, 2, '.', '');

        // Checking for status
        if($row->status == 1)
            $status = 'AKTIF';
        else
            $status = 'TIDAK AKTIF';

        // Increment the counter for "BIL" column
        $this->counter++;

        // Update total values
        $this->totalBayaran += $bayaran;

        return [
             $this->counter,
             $row->nama,
             $row->no_kp,
             strtoupper($row->nama_kursus),
             $tempoh_tajaan,
             $status,
             number_format($bayaran, 2, '.', ''), 
             $row->no_baucer,
             strtoupper($row->perihal),
             Carbon::parse($row->tarikh_transaksi)->format('d/m/Y'),
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

        // Get the current month in Malay
        $currentMonth = Carbon::now()->translatedFormat('F');

        // Convert the month name to uppercase
        $currentMonth = strtoupper($currentMonth);

        return $currentMonth;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Retrieve additional data for custom headers from the database
                $customHeaderData = [
                    ['INSTITUSI:', $this->getInstitusiData()],
                    ['CAWANGAN:'],
                    ['BULAN:', $this->getBulanData()],
                    [''],
                    ['LAPORAN BAYARAN PROGRAM BKOKU (SPBB 2)'],
                ];

                foreach ($customHeaderData as $index => $rowData) {
                    $rowNumber = $index + 1;
                    
                    foreach ($rowData as $columnIndex => $cellData) {
                        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex + 1);

                        // Merge cells for custom headers
                        if (in_array($cellData, ['INSTITUSI:', 'CAWANGAN:', 'BULAN:'])) {
                            // Merge cells and apply data
                            $event->sheet->mergeCells("{$columnLetter}{$rowNumber}:B{$rowNumber}");
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                            // Check if the next column's data exists before accessing it
                            if (isset($rowData[$columnIndex + 1])) {
                                $event->sheet->setCellValue('C' . $rowNumber, $rowData[$columnIndex + 1]);
                            }
                        } 
                        else {
                            // For other cells, just set the value
                            $event->sheet->setCellValue($columnLetter . $rowNumber, $cellData);
                        }
                    }
                }

                // Get the row number where the table headers start
                $dataHeaderRow = 6; 

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


                // Center the "LAPORAN BAYARAN PROGRAM BKOKU (SPBB 2)" row and make it span all columns
                $event->sheet->mergeCells('A5:' . $event->sheet->getHighestColumn() . '5');
                $event->sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                

                // Add borders and align to the data table
                $startRow = 5; 
                $startColumn = 'A';
                $endColumn = 'J'; 
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
                    // Custom row for total
                    ['JUMLAH', '', '', '', '', '', $totalBayaranFormatted],
                ]);

                // Corrected code set background for jumlah
                $event->sheet->getStyle('A' . ($lastRow + 1) . ':J' . ($lastRow + 1))->applyFromArray([
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

                $event->sheet->getStyle('A' . ($lastRow + 3))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('A' . ($lastRow + 3), "i) Disahkan maklumat diatas adalah benar dan bayaran telah dibuat sewajarnya. (Salinan baucar bayaran hendaklah difailkan Khas untuk SALUR PERUNTUKAN BKOKU di setiap UA - Kementerian Pendidikan Tinggi akan membuat pemantauan/semakan dari semasa ke semasa)");

                $event->sheet->getStyle('B' . ($lastRow + 6))->getFont()->setSize(10);
                $event->sheet->setCellValue('B' . ($lastRow + 6), 'Disediakan oleh:');

                $event->sheet->getStyle('B' . ($lastRow + 7))->getFont()->setSize(10);
                $event->sheet->setCellValue('B' . ($lastRow + 7), 'Cop & tandatangan');

                $event->sheet->getStyle('B' . ($lastRow + 9))->getFont()->setSize(10);
                $event->sheet->setCellValue('B' . ($lastRow + 9), 'Tarikh:');

                $event->sheet->getStyle('D' . ($lastRow + 6))->getFont()->setSize(10);
                $event->sheet->setCellValue('D' . ($lastRow + 6), 'Disemak oleh:');

                $event->sheet->getStyle('D' . ($lastRow + 7))->getFont()->setSize(10);
                $event->sheet->setCellValue('D' . ($lastRow + 7), 'Cop & tandatangan');

                $event->sheet->getStyle('D' . ($lastRow + 9))->getFont()->setSize(10);
                $event->sheet->setCellValue('D' . ($lastRow + 9), 'Tarikh:');

                $event->sheet->getStyle('G' . ($lastRow + 6))->getFont()->setSize(10);
                $event->sheet->setCellValue('G' . ($lastRow + 6), 'Disahkan oleh:');

                $event->sheet->getStyle('G' . ($lastRow + 7))->getFont()->setSize(10);
                $event->sheet->setCellValue('G' . ($lastRow + 7), 'Cop & tandatangan');

                $event->sheet->getStyle('G' . ($lastRow + 9))->getFont()->setSize(10);
                $event->sheet->setCellValue('G' . ($lastRow + 9), 'Tarikh:');

            },
        ];
    }
}
