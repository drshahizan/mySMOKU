<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SenaraiPendekUA implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    private $programCode;
    private $filters;
    private $bil = 1;

    public function __construct($programCode, $filters)
    {
        $this->programCode = $programCode;
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DB::table('permohonan as a')
            ->join('smoku as d', 'd.id', '=', 'a.smoku_id')
            ->join('smoku_akademik as b', function ($join) {
                $join->on('b.smoku_id', '=', 'a.smoku_id')
                    ->where('b.status', 1);
            })
            ->join('bk_info_institusi as c', 'c.id_institusi', '=', 'b.id_institusi')
            ->leftJoin('smoku_butiran_pelajar as bp', 'bp.smoku_id', '=', 'a.smoku_id')
            ->leftJoin('smoku_waris as w', 'w.smoku_id', '=', 'a.smoku_id')
            ->leftJoin('bk_sumber_biaya as sb', 'sb.kod_biaya', '=', 'b.sumber_biaya')
            ->leftJoin('bk_penaja as pn', 'pn.id', '=', 'b.nama_penaja')
            ->leftJoin('bk_mod as md', 'md.kod_mod', '=', 'b.mod')
            ->leftJoin('bk_jenis_oku as oku', 'oku.kod_oku', '=', 'd.kategori')
            ->leftJoin('bk_peringkat_pengajian as pp', 'pp.kod_peringkat', '=', 'b.peringkat_pengajian')
            ->leftJoin('bk_bandar as bandar', 'bandar.id', '=', 'bp.alamat_tetap_bandar')
            ->leftJoin('bk_negeri as negeri', 'negeri.id', '=', 'bp.alamat_tetap_negeri')
            ->leftJoin('bk_bandar as surat_bandar', 'surat_bandar.id', '=', 'bp.alamat_surat_bandar')
            ->leftJoin('bk_negeri as surat_negeri', 'surat_negeri.id', '=', 'bp.alamat_surat_negeri')
            ->leftJoin('bk_negeri as negeri_lahir', 'negeri_lahir.id', '=', 'bp.negeri_lahir')
            ->leftJoin('bk_agama as agama', 'agama.id', '=', 'bp.agama')
            ->leftJoin('bk_jantina as jantina', 'jantina.kod_jantina', '=', 'd.jantina')
            ->leftJoin('bk_keturunan as keturunan', 'keturunan.id', '=', 'd.keturunan')
            ->where('a.status', 4);

        $query->where('a.program', 'BKOKU')->where('c.jenis_institusi', 'UA');

        if (!empty($this->filters['institusi'])) {
            $query->where('c.id_institusi', $this->filters['institusi']);
        }

        return $query->select(
                'a.id',
                'a.no_rujukan_permohonan',
                'a.program',
                'a.tarikh_hantar',
                'a.status',
                'a.status_pemohon',
                'd.nama',
                'd.no_kp',
                'd.tarikh_lahir',
                'd.umur',
                'd.no_daftar_oku',
                'd.email',
                'bp.emel as emel_butiran',
                'bp.no_akaun_bank',
                'bp.status_pekerjaan as status_pekerjaan_butiran',
                'bp.alamat_tetap',
                'bp.alamat_surat_menyurat',
                'bp.alamat_tetap_poskod',
                'bp.alamat_surat_poskod',
                'bp.tel_bimbit as tel_bimbit_butiran',
                'bp.tel_rumah as tel_rumah_butiran',
                'd.tel_bimbit',
                'd.tel_rumah',
                'd.status_pekerjaan',
                'w.pendapatan_waris',
                'sb.biaya',
                'b.sumber_lain',
                'pn.penaja',
                'b.penaja_lain',
                'md.mod',
                'b.no_pendaftaran_pelajar',
                'b.tempoh_pengajian',
                'b.bil_bulan_per_sem',
                'b.sesi',
                'b.sem_semasa',
                'b.nama_kursus',
                'b.tarikh_mula',
                'b.tarikh_tamat',
                'c.nama_institusi',
                'c.jenis_institusi',
                'oku.kecacatan',
                'pp.peringkat',
                'bandar.bandar',
                'negeri.negeri',
                'surat_bandar.bandar as bandar_surat',
                'surat_negeri.negeri as negeri_surat',
                'negeri_lahir.negeri as negeri_lahir',
                'agama.agama',
                'jantina.jantina',
                'keturunan.keturunan'
            )
            ->orderBy('a.updated_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'BIL.',
            'PROGRAM',
            'STATUS PELAJAR',
            'NAMA',
            'NO. KAD PENGENALAN',
            'TARIKH LAHIR',
            'NEGERI LAHIR',
            'UMUR',
            'JANTINA',
            'KETURUNAN',
            'AGAMA',
            'ALAMAT TETAP',
            'BANDAR',
            'POSKOD',
            'NEGERI',
            'ALAMAT SURAT MENYURAT',
            'BANDAR',
            'POSKOD',
            'NEGERI',
            'ALAMAT E-MEL',
            'NO. TEL BIMBIT',
            'NO. TEL RUMAH',
            'STATUS PEKERJAAN',
            'NO. JKM',
            'KATEGORI KECACATAN',
            'WARGANEGARA',
            'NO AKAUN BANK',
            'JENIS BANK',
            'JENIS IPT',
            'NAMA PUSAT PENGAJIAN',
            'PERINGKAT PENGAJIAN',
            'NAMA KURSUS',
            'SESI PENGAJIAN SEMASA',
            'MOD PENGAJIAN',
            'NO. PENDAFTARAN PELAJAR',
            'TEMPOH PENGAJIAN',
            'SEMESTER SEMASA',
            'BIL BULAN PERSEMESTER',
            'TARIKH MULA PENGAJIAN',
            'TARIKH TAMAT PENGAJIAN',
            'SUMBER PEMBIAYAAN',
            'NAMA PENAJA',
            'TARIKH PERMOHONAN',
            'STATUS PERMOHONAN',
            'MEDIUM',
            'PENDAPATAN BULANAN WARIS (RM)',
            'CATATAN',
        ];
    }

    public function map($row): array
    {
        return [
            $this->bil++,
            $this->uppercase($row->program),
            'BAHARU',
            $this->uppercase($row->nama),
            $row->no_kp,
            $this->dateMalay($row->tarikh_lahir),
            $this->uppercase($row->negeri_lahir),
            $row->umur,
            $this->uppercase($row->jantina),
            $this->uppercase($row->keturunan),
            $this->uppercase($row->agama),
            $this->uppercase($row->alamat_tetap),
            $this->uppercase($row->bandar),
            $row->alamat_tetap_poskod,
            $this->uppercase($row->negeri),
            $this->uppercase($row->alamat_surat_menyurat),
            $this->uppercase($row->bandar_surat),
            $row->alamat_surat_poskod,
            $this->uppercase($row->negeri_surat),
            $this->lowercase($row->email ?: $row->emel_butiran),
            $row->tel_bimbit_butiran ?: $row->tel_bimbit,
            $row->tel_rumah_butiran ?: $row->tel_rumah,
            $this->uppercase($row->status_pekerjaan_butiran ?: $row->status_pekerjaan),
            $this->uppercase($row->no_daftar_oku),
            $this->uppercase($row->kecacatan),
            'MALAYSIA',
            $row->no_akaun_bank,
            'BIMB',
            $this->uppercase($row->jenis_institusi),
            $this->uppercase($row->nama_institusi),
            $this->uppercase($row->peringkat),
            $this->uppercase($row->nama_kursus),
            $this->uppercase($row->sesi),
            $this->uppercase($row->mod),
            $this->uppercase($row->no_pendaftaran_pelajar),
            $row->tempoh_pengajian,
            $row->sem_semasa,
            $row->bil_bulan_per_sem,
            $this->dateMalay($row->tarikh_mula),
            $this->dateMalay($row->tarikh_tamat),
            $this->uppercase($row->biaya ?: $row->sumber_lain),
            $this->uppercase($row->penaja_lain ?: $row->penaja),
            $this->dateMalay($row->tarikh_hantar),
            $this->uppercase($row->status_pemohon ?: $this->statusLabel($row->status)),
            'SISPO',
            $this->formatCurrency($row->pendapatan_waris),
            '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestColumn = $event->sheet->getHighestColumn();
                $highestRow = $event->sheet->getHighestRow();

                $event->sheet->getDefaultRowDimension()->setRowHeight(45);
                $event->sheet->getRowDimension(1)->setRowHeight(90);

                $event->sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'],
                        'size' => 11,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '00AEEA'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                if ($highestRow > 1) {
                    $event->sheet->getStyle('A2:' . $highestColumn . $highestRow)->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ],
                    ]);
                }

                foreach (['A', 'C', 'F', 'L', 'O', 'R', 'S'] as $column) {
                    $event->sheet->getColumnDimension($column)->setWidth(32);
                }
            },
        ];
    }

    private function statusLabel($status)
    {
        $statuses = [
            '1' => 'DERAF',
            '2' => 'BARU',
            '3' => 'SEDANG DISARING',
            '4' => 'DISOKONG',
            '5' => 'DIKEMBALIKAN',
            '6' => 'LAYAK',
            '7' => 'TIDAK LAYAK',
            '8' => 'DIBAYAR',
            '9' => 'BATAL',
            '10' => 'BERHENTI',
        ];

        return $statuses[(string) $status] ?? '';
    }

    private function dateMalay($date)
    {
        if (empty($date)) {
            return '';
        }

        $months = [
            1 => 'JANUARI',
            2 => 'FEBRUARI',
            3 => 'MAC',
            4 => 'APRIL',
            5 => 'MEI',
            6 => 'JUN',
            7 => 'JULAI',
            8 => 'OGOS',
            9 => 'SEPTEMBER',
            10 => 'OKTOBER',
            11 => 'NOVEMBER',
            12 => 'DISEMBER',
        ];

        $carbon = Carbon::parse($date);

        return $carbon->format('d') . ' ' . $months[(int) $carbon->format('n')] . ' ' . $carbon->format('Y');
    }

    private function formatCurrency($value)
    {
        $amount = (float) str_replace(',', '', $value ?: 0);

        return 'RM' . number_format($amount, 2);
    }

    private function uppercase($value)
    {
        return empty($value) ? '' : mb_strtoupper($value, 'UTF-8');
    }

    private function lowercase($value)
    {
        return empty($value) ? '' : mb_strtolower($value, 'UTF-8');
    }
}