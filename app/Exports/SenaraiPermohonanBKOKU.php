<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SenaraiPermohonanBKOKU implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    /**
     * Constructor
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    /**
     * Return collection of data to export
     */
    public function collection()
    {
        return $this->data->map(function ($item, $index) {
            $akademik = $item->akademik->first();
            $permohonan = $item->permohonan->first();

            return [
                'Bil' => $index + 1,
                'Sumber Pembiayaan' => $akademik->sumberRelation->biaya ?? '-',
                'Nama Penaja' => $akademik->nama_penaja == '99'
                    ? (strtoupper($akademik->penaja_lain) ?? '-')
                    : ($akademik->penajaRelation->penaja ?? '-'),
                'Status Pengajian' => ($akademik->tarikh_tamat && \Carbon\Carbon::parse($akademik->tarikh_tamat)->gte(now()))
                    ? 'AKTIF'
                    : 'TIDAK AKTIF',
                'Mod Pengajian' => $akademik->modRelation->mod ?? '-',
                'Alamat Emel' => $item->email ?? '-',
                'Nama' => strtoupper($item->nama) ?? '-',
                'No. KP' => $item->no_kp ?? '-',
                'No. Matrik' => $akademik->no_pendaftaran_pelajar ?? '-',
                'No. JKM' => $item->no_daftar_oku ?? '-',
                'Kategori Kecacatan' => $item->okuRelation?->kecacatan ?? '-',
                'Semester' => $akademik->sem_semasa ?? '-',
                'Nama Pusat Pengajian' => strtoupper($akademik->infoipt->nama_institusi) ?? '-',
                'Jenis Institusi' => $akademik->infoipt->jenis_institusi ?? '-',
                'Peringkat Pengajian' => $akademik->peringkat->peringkat ?? '-',
                'Nama Kursus' => $akademik->nama_kursus ?? '-',
                'No. Akaun Bank' => $item->butiranPelajar->no_akaun_bank ?? '-',
                'Jenis Bank' => '-',
                'Alamat Tetap' => $item->butiranPelajar->alamat_tetap ?? '-',
                'Bandar' => $item->butiranPelajar->bandar->bandar ?? '-',
                'Poskod' => $item->butiranPelajar->alamat_tetap_poskod ?? '-',
                'Negeri' => $item->butiranPelajar->negeri->negeri ?? '-',
                'Parlimen' => $item->butiranPelajar->parlimenRelation
                    ? $item->butiranPelajar->parlimenRelation->kod_parlimen . ' - ' . strtoupper($item->butiranPelajar->parlimenRelation->parlimen)
                    : '-',
                'DUN' => $item->butiranPelajar->dunRelation
                    ? $item->butiranPelajar->dunRelation->kod_dun . ' - ' . strtoupper($item->butiranPelajar->dunRelation->dun)
                    : '-',
                'No. Telefon' => $item->butiranPelajar->tel_bimbit ?? '-',
                'Tarikh Mula Pengajian' => $akademik->tarikh_mula ? date('d/m/Y', strtotime($akademik->tarikh_mula)) : '-',
                'Tarikh Tamat Pengajian' => $akademik->tarikh_tamat ? date('d/m/Y', strtotime($akademik->tarikh_tamat)) : '-',
                'Tempoh Pengajian (Tahun)' => $akademik->tempoh_pengajian ?? '-',
                'Tarikh Kelulusan' => $permohonan->kelulusanRelation->created_at
                    ? date('d/m/Y', strtotime($permohonan->kelulusanRelation->created_at))
                    : '-',
                'Jantina' => $item->jantina ?? '-',
                'Keturunan' => $item->keturunanRelation?->keturunan ?? '-',
                'Agama' => $item->butiranPelajar->agamaRelation->agama ?? '-',
                'Catatan' => ' ',
            ];
        });
    }

    /**
     * Headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'Bil',
            'Sumber Pembiayaan',
            'Nama Penaja',
            'Status',
            'Mod Pengajian',
            'Alamat Emel',
            'Nama',
            'No. KP',
            'No. Matrik',
            'No. JKM',
            'Kategori Kecacatan',
            'Semester',
            'Nama Pusat Pengajian',
            'Jenis Institusi',
            'Peringkat Pengajian',
            'Nama Kursus',
            'No. Akaun Bank',
            'Jenis Bank',
            'Alamat Tetap',
            'Bandar',
            'Poskod',
            'Negeri',
            'Parlimen',
            'DUN',
            'No. Telefon',
            'Tarikh Mula Pengajian',
            'Tarikh Tamat Pengajian',
            'Tempoh Pengajian (Tahun)',
            'Tarikh Kelulusan',
            'Jantina',
            'Keturunan',
            'Agama',
            'Catatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Row 1 (header row)
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '0000CD', // Blue color
                    ],
                ],
                'alignment' => [
                    'wrapText' => true,
                ],
            ],
        ];
    }
    

}
