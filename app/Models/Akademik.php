<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;
    protected $table = 'smoku_akademik';

    protected $fillable = [
        'smoku_id',
        'no_pendaftaran_pelajar',
        'peringkat_pengajian',
        'nama_kursus',
        'id_institusi',
        'sesi',
        'tarikh_mula',
        'tarikh_tamat',
        'sem_semasa',
        'tempoh_pengajian',
        'bil_bulan_per_sem',
        'mod',
        'cgpa',
        'sumber_biaya',
        'nama_penaja',
        'status',
        
        
    ];

}
