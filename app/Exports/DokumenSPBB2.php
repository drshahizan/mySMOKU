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
use Illuminate\Support\Facades\Log;


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

        // Fetch data from Permohonan table
        $permohonanData = $this->fetchPermohonanData($sesiBayaran);

        // Fetch data from Tuntutan table
        $tuntutanData = $this->fetchTuntutanData($sesiBayaran);

        // Merge the data for students with the same smoku_id
        $mergedData = $this->mergeData($permohonanData, $tuntutanData);

        // Convert $mergedData to a collection
        $mergedDataCollection = collect($mergedData);

        // Return the collection
        return $mergedDataCollection;
    }

    protected function fetchPermohonanData($sesiBayaran)
    {
        $permohonanData =  Permohonan::join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('permohonan.status', 8)
            ->where('permohonan.sesi_bayaran', $sesiBayaran)
            ->where('bk_info_institusi.id_institusi', $this->instiusi_user)
            ->select(
                'smoku.id as smoku_id',
                'smoku.nama',
                'smoku.no_kp',
                DB::raw('MAX(smoku_akademik.tarikh_mula) as tarikh_mula'),
                DB::raw('MAX(smoku_akademik.tarikh_tamat) as tarikh_tamat'),
                DB::raw('MAX(smoku_akademik.nama_kursus) as nama_kursus'),
                DB::raw('GROUP_CONCAT(permohonan.no_baucer) as no_baucer'),
                DB::raw('GROUP_CONCAT(permohonan.tarikh_baucer) as tarikh_baucer'),
                DB::raw('GROUP_CONCAT(permohonan.tarikh_transaksi) as tarikh_transaksi'),
                DB::raw('GROUP_CONCAT(permohonan.perihal) as perihal'),
                DB::raw('GROUP_CONCAT(permohonan.status_pemohon) as status_pemohon'),
                DB::raw('SUM(permohonan.yuran_dibayar) as total_yuran_dibayar'),
                DB::raw('SUM(permohonan.wang_saku_dibayar) as total_wang_saku_dibayar')
            )
            ->groupBy('smoku.id', 'smoku.nama', 'smoku.no_kp')
            ->get();
        
        return $permohonanData;
    }

    protected function fetchTuntutanData($sesiBayaran)
    {
        $tuntutanData = Tuntutan::join('smoku', 'smoku.id', '=', 'tuntutan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tuntutan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('tuntutan.status', 8)
            ->where('tuntutan.sesi_bayaran', $sesiBayaran)
            ->where('bk_info_institusi.id_institusi', $this->instiusi_user)
            ->select(
                'smoku.id as smoku_id',
                'smoku.nama',
                'smoku.no_kp',
                DB::raw('MAX(smoku_akademik.tarikh_mula) as tarikh_mula'),
                DB::raw('MAX(smoku_akademik.tarikh_tamat) as tarikh_tamat'),
                DB::raw('MAX(smoku_akademik.nama_kursus) as nama_kursus'),
                DB::raw('GROUP_CONCAT(tuntutan.no_baucer) as no_baucer'), 
                DB::raw('GROUP_CONCAT(tuntutan.tarikh_baucer) as tarikh_baucer'),
                DB::raw('GROUP_CONCAT(tuntutan.tarikh_transaksi) as tarikh_transaksi'),
                DB::raw('GROUP_CONCAT(tuntutan.perihal) as perihal'),
                DB::raw('GROUP_CONCAT(tuntutan.status_pemohon) as status_pemohon'),
                DB::raw('SUM(tuntutan.yuran_dibayar) as total_yuran_dibayar'),
                DB::raw('SUM(tuntutan.wang_saku_dibayar) as total_wang_saku_dibayar')
            )
            ->groupBy('smoku.id', 'smoku.nama', 'smoku.no_kp')
            ->get();
        
        return $tuntutanData;
    }

    protected function mergeData($permohonanData, $tuntutanData)
    {
        $mergedData = [];

        foreach ($permohonanData as $permohonanRow) {
            $smokuId = $permohonanRow->smoku_id;

            // Check if there is a corresponding Tuntutan data for the current smoku_id
            $tuntutanRow = $tuntutanData->where('smoku_id', $smokuId)->first();

            if ($tuntutanRow) {
                // Combine data for Permohonan and Tuntutan
                $mergedRow = [
                    'nama' => $permohonanRow->nama,
                    'no_kp' => $permohonanRow->no_kp,
                    'nama_kursus' => $permohonanRow->nama_kursus,
                    'tarikh_mula' => $permohonanRow->tarikh_mula,
                    'tarikh_tamat' => $permohonanRow->tarikh_tamat,
                    'status_pemohon' => $permohonanRow->status_pemohon,
                    'bayaran' => $permohonanRow->total_yuran_dibayar + $permohonanRow->total_wang_saku_dibayar +
                                    $tuntutanRow->total_yuran_dibayar + $tuntutanRow->total_wang_saku_dibayar,
                    'no_baucer' => $permohonanRow->no_baucer . ' & ' . $tuntutanRow->no_baucer,
                    'perihal' => $permohonanRow->perihal . ' & ' . $tuntutanRow->perihal,
                    'tarikh_transaksi' => $tuntutanRow->tarikh_transaksi,
                    'tarikh_baucer' => $tuntutanRow->tarikh_baucer
                ];

                $mergedData[] = $mergedRow;
            } else {
                // Only Permohonan data exists
                $mergedData[] = [
                    'nama' => $permohonanRow->nama,
                    'no_kp' => $permohonanRow->no_kp,
                    'nama_kursus' => $permohonanRow->nama_kursus,
                    'tarikh_mula' => $permohonanRow->tarikh_mula,
                    'tarikh_tamat' => $permohonanRow->tarikh_tamat,
                    'status_pemohon' => $permohonanRow->status_pemohon,
                    'bayaran' => $permohonanRow->total_yuran_dibayar + $permohonanRow->total_wang_saku_dibayar,
                    'no_baucer' => $permohonanRow->no_baucer,
                    'perihal' => $permohonanRow->perihal,
                    'tarikh_transaksi' => $permohonanRow->tarikh_transaksi,
                    'tarikh_baucer' => $permohonanRow->tarikh_baucer
                ];
            }
        }

        // Add Tuntutan data that doesn't have corresponding Permohonan data
        foreach ($tuntutanData as $tuntutanRow) 
        {
            $smokuId = $tuntutanRow->smoku_id;

            if (!$permohonanData->where('smoku_id', $smokuId)->first()) {
                $mergedData[] = [
                    'nama' => $tuntutanRow->nama,
                    'no_kp' => $tuntutanRow->no_kp,
                    'nama_kursus' => $tuntutanRow->nama_kursus,
                    'tarikh_mula' => $tuntutanRow->tarikh_mula,
                    'tarikh_tamat' => $tuntutanRow->tarikh_tamat,
                    'status_pemohon' => $tuntutanRow->status_pemohon,
                    'bayaran' => $tuntutanRow->total_yuran_dibayar + $tuntutanRow->total_wang_saku_dibayar,
                    'no_baucer' => $tuntutanRow->no_baucer,
                    'perihal' => $tuntutanRow->perihal,
                    'tarikh_transaksi' => $tuntutanRow->tarikh_transaksi,
                    'tarikh_baucer' => $tuntutanRow->tarikh_baucer
                ];
            }
        }

        // dd($mergedData);

        return $mergedData;
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
            'B' => 40,           
            'C' => 15,
            'D' => 35,
            'E' => 25,
            'F' => 15,
            'G' => 20,
            'H' => 25,
            'I' => 30,
            'J' => 20,
        ];
    }

    public function map($row): array
    {
        // Increment the counter for "BIL" column
        $this->counter++;

        // Retrieve tarikh mula & tamat pengajian
        $tarikh_mula = Carbon::parse($row['tarikh_mula'])->format('d/m/Y');
        $tarikh_tamat = Carbon::parse($row['tarikh_tamat'])->format('d/m/Y');

        // Concatenate the formatted dates with the desired format
        $tempoh_tajaan = $tarikh_mula . ' - ' . $tarikh_tamat;

        // Concatenate the no_baucer 
        $baucer = $row['no_baucer'];

        // Split the concatenated baucer string into individual baucer numbers
        $baucerNumbers = explode(' & ', $baucer);

        // Convert the array of baucer numbers to a string
        $baucerString = implode(' & ', $baucerNumbers);

        // Get rujukan bayaran
        $rujukanBayaran = $baucerString . ' ' . Carbon::parse($row['tarikh_baucer'])->format('d/m/Y');

        // Calculate the total of yuran dibayar & wang saku dibayar
        $bayaran = number_format($row['bayaran'], 2, '.', '');

        // Update total values
        $this->totalBayaran += $bayaran;

        return [
            $this->counter,
            $row['nama'],
            $row['no_kp'],
            strtoupper($row['nama_kursus']),
            $tempoh_tajaan,
            strtoupper($row['status_pemohon']),
            $bayaran,
            $rujukanBayaran, 
            strtoupper($row['perihal']),
            Carbon::parse($row['tarikh_transaksi'])->format('d/m/Y'),
        ];
    }

    private function getInstitusiData()
    {
        $institusiData = DB::table('bk_info_institusi')->where('id_institusi', $this->instiusi_user)->value('nama_institusi');
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

        $currentMonth = strtoupper($currentMonth);
        $bulanTahun = $currentMonth . ' ' . $currentYear;

        return $bulanTahun;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $currentYear = Carbon::now()->year;
                $sesiBayaran = $currentYear . '/'. $currentYear+1;

                // Retrieve additional data for custom headers from the database
                $customHeaderData = [
                    ['INSTITUSI:', $this->getInstitusiData()],
                    ['CAWANGAN:'],
                    ['BULAN:', $this->getBulanData()],
                    [''],
                    ['LAPORAN BAYARAN PROGRAM BKOKU BAGI SESI ' . $sesiBayaran . ' (SPBB 2)'],
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

                // Set alignment and style for the entire header row
                $headerRange = 'A1:' . $event->sheet->getHighestColumn() . '3'; // Assuming the header row is from B1 to the last column in row 3
                $event->sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);


                // Get the row number where the table headers start
                $dataHeaderRow = 6; 

                // Customize the style of the data header row
                $event->sheet->getStyle('A' . $dataHeaderRow . ':' . $event->sheet->getHighestColumn() . $dataHeaderRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '#000000'], // Data header font color 
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
                        'size' => 12, 
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
                            'color' => ['rgb' => '000000'], 
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
                    ['JUMLAH (RM)', '', '', '', '', '', $totalBayaranFormatted],
                ]);

                // Corrected code set background for jumlah
                $event->sheet->getStyle('A' . ($lastRow + 1) . ':J' . ($lastRow + 1))->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3'], 
                    ],
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

                $event->sheet->mergeCells('A' . ($lastRow + 3) . ':J' . ($lastRow + 4));
                $event->sheet->getStyle('A' . ($lastRow + 3))->getFont()->setSize(10)->setBold(true);
                $event->sheet->setCellValue('A' . ($lastRow + 3), "i) Disahkan maklumat diatas adalah benar dan bayaran telah dibuat sewajarnya.\n(Salinan baucar bayaran hendaklah difailkan Khas untuk SALUR PERUNTUKAN BKOKU di setiap UA - Kementerian Pendidikan Tinggi akan membuat pemantauan/semakan dari semasa ke semasa)");

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
