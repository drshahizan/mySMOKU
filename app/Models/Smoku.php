<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smoku extends Model
{
    use HasFactory;
    protected $table = 'smoku';

    public function jantina()
    {
        return $this->belongsTo('App\Models\Jantina', 'jantina', 'kod_jantina');
    }

    public function keturunan()
    {
        return $this->belongsTo('App\Models\Keturunan', 'keturunan', 'kod_keturunan');
    }

    public function hubungan()
    {
        return $this->belongsTo('App\Models\Hubungan', 'hubungan_waris', 'kod_hubungan');
    }

    public function jenisOku()
    {
        return $this->belongsTo('App\Models\JenisOku', 'kategori', 'kod_oku');
    }

    protected $fillable = [
        'no_kp',
        'no_id_tentera',
        'nama',
        'no_daftar_oku',
        'kategori',
        'jantina',
        'tarikh_lahir',
        'umur',
        'keturunan',
        'tel_rumah',
        'tel_bimbit',
        'email',
        'pekerjaan',
        'pendapatan',
        'status_pekerjaan',
        'alamat_tetap',
        'alamat_surat_menyurat',
        'parlimen',
        'dun',
        'nama_waris',
        'tel_bimbit_waris',
        'hubungan_waris',
        'pekerjaan_waris',
        'pendapatan_waris',
    ];

}
