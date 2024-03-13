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

class DokumenSPBB2a implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $instiusi_user;
    private $counter = 0;
    private $totalDisokong = 0;
    private $totalDibayar = 0;
    private $totalBaki = 0;
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
         } else{
            $sesiBayaran = '4/' . $currentYear;
         }

        // Fetch data from Tuntutan table with status 10
        $senaraiTuntutan = Tuntutan::join('smoku as b', 'b.id', '=', 'tuntutan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'tuntutan.smoku_id')
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->where('tuntutan.status', 10)
            ->where('tuntutan.sesi_bayaran', $sesiBayaran)
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'g.peringkat',
                'tuntutan.yuran_dibayar',
                'tuntutan.wang_saku_dibayar',
                'tuntutan.yuran_disokong',
                'tuntutan.wang_saku_disokong',
                'tuntutan.no_baucer',
                'tuntutan.tarikh_transaksi',  
                'tuntutan.status_pemohon',  
                'tuntutan.perihal',  
            );;

        // Fetch data from Permohonan table with status 10
        $senaraiPermohonan = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->where('permohonan.status', 10)
            ->where('permohonan.sesi_bayaran', $sesiBayaran)
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'g.peringkat',
                'permohonan.yuran_dibayar',
                'permohonan.wang_saku_dibayar',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.no_baucer',
                'permohonan.tarikh_transaksi', 
                'permohonan.status_pemohon',   
                'permohonan.perihal',    
            );

        // Fetch data from Tuntutan table with status 8 and additional conditions
        $senaraiTuntutanStatus8 = Tuntutan::join('smoku as b', 'b.id', '=', 'tuntutan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'tuntutan.smoku_id')
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->join('tuntutan_saringan as a', 'a.tuntutan_id','=','tuntutan.id')
            ->where('tuntutan.status', 8)
            ->where('tuntutan.sesi_bayaran', $sesiBayaran)
            ->where(function($query) {
                $query->whereColumn('tuntutan.yuran_dibayar', '!=', 'tuntutan.yuran_disokong')
                    ->orWhereColumn('tuntutan.wang_saku_dibayar', '!=', 'tuntutan.wang_saku_disokong');
            })
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'g.peringkat',
                'tuntutan.yuran_dibayar',
                'tuntutan.wang_saku_dibayar',
                'tuntutan.yuran_disokong',
                'tuntutan.wang_saku_disokong',
                'tuntutan.no_baucer',
                'tuntutan.tarikh_transaksi',  
                'tuntutan.status_pemohon',  
                'tuntutan.perihal',  
            );;

        // Fetch data from Permohonan table with status 8 and additional conditions
        $senaraiPermohonanStatus8 = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_sumber_biaya as e','c.sumber_biaya','=','e.kod_biaya')
            ->join('bk_info_institusi as f', 'f.id_institusi', '=', 'c.id_institusi')
            ->join('bk_peringkat_pengajian as g','g.kod_peringkat','=','c.peringkat_pengajian')
            ->join('bk_mod as h','h.kod_mod','=','c.mod')
            ->where('permohonan.status', 8)
            ->where('permohonan.sesi_bayaran', $sesiBayaran)
            ->where(function($query) {
                $query->whereColumn('permohonan.yuran_dibayar', '!=', 'permohonan.yuran_disokong')
                    ->orWhereColumn('permohonan.wang_saku_dibayar', '!=', 'permohonan.wang_saku_disokong');
            })
            ->where('f.id_institusi', $this->instiusi_user)
            ->select(
                'b.id',
                'b.nama',
                'b.no_kp',
                'c.tarikh_mula',
                'c.tarikh_tamat',
                'c.nama_kursus',
                'g.peringkat',
                'permohonan.yuran_dibayar',
                'permohonan.wang_saku_dibayar',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.no_baucer',
                'permohonan.tarikh_transaksi', 
                'permohonan.status_pemohon',   
                'permohonan.perihal',    
            );

        // Combine the results of all queries
        $senarai = $senaraiTuntutan->union($senaraiPermohonan)
            ->union($senaraiTuntutanStatus8)
            ->union($senaraiPermohonanStatus8)
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
            ['LAPORAN KUTIPAN BALIK BAGI PELAJAR BKOKU YANG TARIK DIRI/ BERHENTI'], 

            // Data Headers
            array_map('strtoupper', [
                'BIL',
                'NAMA PELAJAR',
                'NO. KAD PENGENALAN',
                'TEMPOH TAJAAN (TARIKH TARIK DIRI)',                
                'STATUS',
                'NAMA KURSUS',
                'PERINGKAT',
                'JUMLAH PATUT BAYAR (RM)',
                'JUMLAH TELAH BAYAR (RM)',
                'BAKI BELUM BAYAR TERKUMPUL (RM)',
                'RUJUKAN NO. RESIT (BUKTI PEMBAYARAN)',
                'CATATAN',
            ]),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,           
            'C' => 20,
            'D' => 20,
            'E' => 15,
            'F' => 30,
            'G' => 15,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 30
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
        $dibayar = number_format($row->yuran_dibayar, 2, '.', '') + number_format($row->wang_saku_dibayar, 2, '.', '');
        $disokong = number_format($row->yuran_disokong, 2, '.', '') + number_format($row->wang_saku_disokong, 2, '.', '');
        $baki = $disokong -  $dibayar;

        // Increment the counter for "BIL" column
        $this->counter++;

        // Update total values
        $this->totalDibayar += $dibayar;
        $this->totalDisokong += $disokong;
        $this->totalBaki += $baki;

        return [
             $this->counter,
             $row->nama,
             $row->no_kp,
             $tempoh_tajaan,
             strtoupper($row->status_pemohon),
             strtoupper($row->nama_kursus),
             $row->peringkat,
             number_format($disokong, 2, '.', ''), 
             number_format($dibayar, 2, '.', ''), 
             number_format($baki, 2, '.', ''), 
             $row->no_baucer,
             strtoupper($row->perihal),
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
                    ['INSTITUSI:', $this->getInstitusiData()],
                    ['CAWANGAN:'],
                    ['BULAN:', $this->getBulanData()],
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
                $endColumn = 'L'; 
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
                $totalBayaranFormatted = number_format($this->totalDibayar , 2, '.', '');
                $totalDisokongFormatted = number_format($this->totalDisokong , 2, '.', '');
                $totalBakiFormatted = number_format($this->totalBaki , 2, '.', '');

                // Add a row at the end to display the total values
                $event->sheet->append([
                    // Custom row for total
                    ['', 'JUMLAH (RM)', '', '', '', '', '', $totalDisokongFormatted, $totalBayaranFormatted, $totalBakiFormatted],
                ]);

                // Corrected code set background for jumlah
                $event->sheet->getStyle('A' . ($lastRow + 1) . ':L' . ($lastRow + 1))->applyFromArray([
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

                $event->sheet->getStyle('E' . ($lastRow + 6))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 6), 'Disemak oleh:');

                $event->sheet->getStyle('E' . ($lastRow + 7))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 7), 'Cop & tandatangan');

                $event->sheet->getStyle('E' . ($lastRow + 9))->getFont()->setSize(10);
                $event->sheet->setCellValue('E' . ($lastRow + 9), 'Tarikh:');

                $event->sheet->getStyle('I' . ($lastRow + 6))->getFont()->setSize(10);
                $event->sheet->setCellValue('I' . ($lastRow + 6), 'Disahkan oleh:');

                $event->sheet->getStyle('I' . ($lastRow + 7))->getFont()->setSize(10);
                $event->sheet->setCellValue('I' . ($lastRow + 7), 'Cop & tandatangan');

                $event->sheet->getStyle('I' . ($lastRow + 9))->getFont()->setSize(10);
                $event->sheet->setCellValue('I' . ($lastRow + 9), 'Tarikh:');

            },
        ];
    }
}
