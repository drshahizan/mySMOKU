<?php

namespace App\Exports;

use App\Models\Akademik;
use App\Models\InfoIpt;
use App\Models\Tuntutan;
use App\Models\TuntutanItem;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class DrafLejarTuntutan implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
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

        // Fetch data from the database based on the institusi ID
        $query = Tuntutan::join('smoku as b', 'b.id', '=', 'tuntutan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tuntutan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('tuntutan.status', 6)
            ->whereNull('tuntutan.data_migrate')
            ->whereIn('bk_info_institusi.id_institusi', $this->id_institusi);

        // Execute the query and get results
        $results = $query->select(
                'tuntutan.smoku_id',
                'tuntutan.no_rujukan_tuntutan',
                'b.nama',
                'tuntutan.yuran',
                'tuntutan.wang_saku',
                'tuntutan.yuran_disokong',
                'tuntutan.wang_saku_disokong',
                'tuntutan.tarikh_hantar'
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
            'ID Tuntutan',
            'Nama Pemohon',
            'Yuran Disokong (RM)',
            'Wang Saku Disokong (RM)',
            'Tarikh Tuntutan',
            'Yuran Dibayar (RM)',
            'Wang Saku Dibayar (RM)',
            'Perihal',
            'No Baucar',
            'Tarikh Baucar',
            'Status (Aktif/Tidak Aktif)'
        ];
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

    private function calculatePerihal($item)
    {
        // Fetch sesi from Akademik table
        // dd($item);
        $sesi = Akademik::where('smoku_id', $item['smoku_id'])->value('sesi');
        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', $item['smoku_id'])->first();
        $tuntutan_item = TuntutanItem::orderBy('id', 'desc')->where('tuntutan_id', $tuntutan->id)->first();
 
        if ($item['yuran'] == 1 && $item['wang_saku'] == 1) {
            $result = 'YURAN PENGAJIAN DAN ELAUN WANG SAKU SESI ' . $tuntutan->sesi;
        } elseif ($item['yuran'] == 1) {
            $result = 'YURAN PENGAJIAN SESI ' . $tuntutan->sesi;
        } elseif ($item['wang_saku'] == 1) {
            $result = 'ELAUN WANG SAKU SESI ' . $tuntutan->sesi;
        } else {
            $result = 'LAIN-LAIN';
        }
        // dd($result);
        return $result;
    }

    public function map($row): array
    {

        // Calculate "perihal" based on the fetched sesi
        $perihal = $this->calculatePerihal($row);

        return [
            // Update this to match with column name in database
            $row->no_rujukan_tuntutan, 
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
