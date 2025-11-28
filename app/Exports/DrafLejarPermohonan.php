<?php

namespace App\Exports;

use App\Models\Akademik;
use App\Models\InfoIpt;
use App\Models\Permohonan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class DrafLejarPermohonan implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_institusi;
    protected $id_user;

    public function __construct($id_institusi)
    {
        $infoipt = InfoIpt::where('id_institusi', $id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null) {
            $infoiptCollection = InfoIpt::where('id_induk', $id_institusi)->get();
        } else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $this->id_institusi = $infoiptCollection->pluck('id_institusi');
        $this->id_user = $infoipt;
    }

    public function collection()
    {

        $query = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('permohonan.status', 6)
            ->whereNull('permohonan.data_migrate')
            ->whereIn('bk_info_institusi.id_institusi', $this->id_institusi);

        // Execute the query and get results
        $results = $query->select(
                'permohonan.smoku_id',
                'permohonan.no_rujukan_permohonan',
                'b.nama',
                'permohonan.yuran',
                'permohonan.wang_saku',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.tarikh_hantar'
            )
            ->get();

        // Add calculated fields to each item in the result
        $results = $results->map(function ($item, $key) {
            $item->perihal = $this->calculatePerihal($item);
            $item->bil = $key + 1;
            return $item;
        });

        return $results;
        
        
    }

    public function headings(): array
    {
        // Define column headings
        return [
            'ID Permohonan',
            'Nama Pemohon',
            'Yuran Disokong (RM)',
            'Wang Saku Disokong (RM)',
            'Tarikh Permohonan',
            'Yuran Dibayar (RM)',
            'Wang Saku Dibayar (RM)',
            'Perihal',
            'No Baucar',
            'Tarikh Baucar',
            'Status (Aktif/Tidak Aktif)'
        ];
    }

    private function calculatePerihal($item)
    {
        // Fetch sesi from Akademik table
        $sesi = Akademik::where('smoku_id', $item['smoku_id'])->value('sesi');
 
        if (($item['yuran_disokong'] != '0.00' && $item['yuran_disokong'] != NULL) && ($item['wang_saku_disokong'] != '0.00' && $item['wang_saku_disokong'] != NULL)) 
        {
            $result = 'YURAN PENGAJIAN DAN ELAUN WANG SAKU SESI ' . $sesi;
        } elseif ($item['yuran_disokong'] != '0.00' && $item['yuran_disokong'] != NULL) {
            $result = 'YURAN PENGAJIAN SESI ' . $sesi;
        } elseif ($item['wang_saku_disokong'] != '0.00' && $item['wang_saku_disokong'] != NULL) {
            $result = 'ELAUN WANG SAKU SESI ' . $sesi;
        } else {
            $result = 'LAIN-LAIN';
        }

        return $result;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 50,           
            'C' => 20,
            'D' => 25,
            'E' => 20,
            'F' => 25,
            'G' => 30,
            'H' => 60,
            'I' => 50,
            'J' => 20,
            'K' => 30,
        ];
    }

    public function map($row): array
    {
        // Calculate "perihal" based on the fetched sesi
        $perihal = $this->calculatePerihal($row);

        return [
            
            // Update this to match with column name in database
            $row->no_rujukan_permohonan, 
            $row->nama,
            number_format((float) preg_replace('/[^\d.]/', '', $row->yuran_disokong), 2, '.', ''), // Format 'Yuran Disokong'
            number_format((float) preg_replace('/[^\d.]/', '', $row->wang_saku_disokong), 2, '.', ''), // Format 'Wang Saku Disokong'
            Carbon::parse($row->tarikh_hantar)->format('d/m/Y'),
            number_format((float) preg_replace('/[^\d.]/', '', $row->yuran_disokong), 2, '.', ''), // Same amount as yuran disokong
            number_format((float) preg_replace('/[^\d.]/', '', $row->wang_saku_disokong), 2, '.', ''), // Same amount as wang saku disokong
            $perihal,
            NULL,
            NULL,
            NULL
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
                        'color' => ['rgb' => 'FFFFFF'], // Header font color 
                        'size' => 12, // Header font size
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '808080'], // Header background color 
                    ],
                ]);

                // Highlight header cells H1 to K1
                $event->sheet->getStyle('F1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // White text
                        'size' => 12,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4CAF50'], // Green background
                    ],
                ]);
            },
        ];
    }
}
