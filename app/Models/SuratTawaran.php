<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTawaran extends Model
{
    protected $table = 'permohonan_surat_tawaran';

    protected $fillable = [
        'no_rujukan',
        'tajuk',
        'tujuan',
        'kandungan1',
        'kandungan2',
        'kandungan3',
        'penutup1',
        'penutup2',
        'penutup3_1',
        'penutup3_2',
        'penutup3_3',
        'penutup3_4',
        'penutup4_1',
        'penutup4_2',
        'penutup4_3',
        'penutup4_4',
    ];
}
