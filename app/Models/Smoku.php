<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Akademik;

class Smoku extends Model
{
    use HasFactory;
    protected $table = 'smoku';

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

    // Define the relationship with Akademik
    public function akademik()
    {
        return $this->hasMany(Akademik::class, 'smoku_id', 'id');
    }

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'smoku_id', 'id');
    }

}
