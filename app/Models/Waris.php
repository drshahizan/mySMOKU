<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waris extends Model
{
    use HasFactory;
    protected $table = 'smoku_waris';

    protected $fillable = [
        'smoku_id',
        'nama_waris',
        'no_kp_waris',
        'no_pasport_waris',
        'hubungan_waris',
        'hubungan_lain_waris',
        'alamat_waris',
        'alamat_negeri_waris',
        'alamat_bandar_waris',
        'alamat_poskod_waris',
        'tel_bimbit_waris',
        'pekerjaan_waris',
        'pendapatan_waris',
        
    ];
}
