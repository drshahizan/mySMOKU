<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;
    protected $table = 'bk_kursus';

    protected $fillable = [
        'no_rujukan',
        'no_sijil',
        'nama_kursus',
        'nama_kursus_bi',
        'kod_nec',
        'bidang',
        'kod_peringkat',
        'kod_pengendalian',
        'kaedah_pengendalian',
        'tarikh_mula',
        'tarikh_tamat',
        'id_institusi',
        'nama_institusi',
        'nama_institusi_bi',
        'institusi_penganugerahan',
        'BilMingguPjg',
        'BilMingguPndk',
        'BilSemPjg',
        'BilSemPndk',
        'BilThn',
        'BilBln',
        'BilThnTo',
        'MingguPanjang',
        'SemPanjang',
        'MingguPendek',
        'SemPendek',
        'PYear',
        'PMonth',
        'PYearTo',
        'PMonthTo',
    ];
}
