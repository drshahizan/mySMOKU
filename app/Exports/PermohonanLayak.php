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

class PermohonanLayak implements FromCollection, WithHeadings, WithColumnWidths, WithEvents, WithMapping
{
    protected $dateFormat = 'd/m/Y';
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Get the institusi ID of the logged-in user
        $instiusi_user = Auth::user()->id_institusi;

        $query = Permohonan::join('smoku as b', 'b.id', '=', 'permohonan.smoku_id')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('permohonan.status', 6)
            ->whereNull('permohonan.data_migrate')
            ->where('bk_info_institusi.id_institusi', $instiusi_user);

        if ($this->startDate !== 'Invalid date' && $this->endDate !== 'Invalid date'){
            $query->whereBetween('permohonan.tarikh_hantar', [$this->startDate, $this->endDate]);
        }

        return $query->select(
                'permohonan.no_rujukan_permohonan',
                'b.nama',
                'permohonan.yuran_disokong',
                'permohonan.wang_saku_disokong',
                'permohonan.tarikh_hantar'
            )->get();
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
            'No Baucar',
            'Perihal',
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
            'H' => 20,
            'I' => 50,
            'J' => 20,
            'K' => 30,
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
            Carbon::parse($row->tarikh_hantar)->format('d/m/Y'),
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
