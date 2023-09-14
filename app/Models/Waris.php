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
        'alamat_tetap_waris',
        'tel_bimbit_waris',
        'hubungan_waris',
        'pendapatan_waris',
        
    ];
}
