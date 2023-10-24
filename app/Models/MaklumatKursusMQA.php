<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaklumatKursusMQA extends Model
{
    use HasFactory;
    protected $table = 'bk_kursus_mqa';

    protected $fillable = [
        'kod_rujukan_akreditasi_penuh',
        'no_siri_sijil',
        'nama_program_bm',
        'nama_program_bi',
        'kod_nec',
        'bidang_program',
        'peringkat_kelayakan',
        'kaedah_pengendalian',
        'tarikh_mula',
        'tarikh_tamat',
        'id_institusi',
        'nama_institusi_bm',
        'nama_institusi_bi',
    ];
}
