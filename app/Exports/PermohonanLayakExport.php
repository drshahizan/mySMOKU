<?php

namespace App\Exports;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class PermohonanLayakExport implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $dateFormat = 'd/m/Y';

    public function collection()
    {
        // Get the institusi ID of the logged-in user
        $instiusi_user = Auth::user()->id_institusi;

        // Fetch data from the database based on the institusi ID
        $senarai = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('permohonan.status', 6)
            ->where('bk_info_institusi.id_institusi', $instiusi_user)
            ->select(
                'permohonan.no_rujukan_permohonan',
                'b.nama',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.created_at'
            )
            ->get();
        
        return $senarai;
    }

    public function headings(): array
    {
        // Define column headings
        return [
            'ID Permohonan',
            'Nama Pemohon',
            'Yuran Disokong',
            'Wang Saku Disokong',
            'Tarikh Permohonan',
            'Yuran Dibayar',
            'Wang Saku Dibayar',
            'No Baucer',
            'Perihal',
            'Tarikh Baucer',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 50,           
            'C' => 20,
            'D' => 25,
            'E' => 25,
            'F' => 40,
            'G' => 40,
            'H' => 30,
            'I' => 50,
            'J' => 30,
        ];
    }

    public function map($row): array
    {
        return [
            // Update this to match with column name in database
            $row->no_rujukan_permohonan, 
            $row->nama,
            number_format($row->yuran_disokong, 2, '.', ''), // Format 'Yuran Disokong' as numeric with two decimal places
            number_format($row->wang_saku_disokong, 2, '.', ''), // Format 'Wang Saku Disokong' as numeric with two decimal places
            Carbon::parse($row->created_at)->format('d/m/Y'),
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
            },
        ];
    }
}
