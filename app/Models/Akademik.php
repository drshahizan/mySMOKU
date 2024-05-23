<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\InfoIpt;
use App\Models\PeringkatPengajian;

class Akademik extends Model
{
    use HasFactory;
    protected $table = 'smoku_akademik';

    protected $fillable = [
        'smoku_id',
        'id_institusi',
        'peringkat_pengajian',
        'nama_kursus',
        'mod',
        'tempoh_pengajian',
        'bil_bulan_per_sem',
        'sesi',
        'no_pendaftaran_pelajar',
        'tarikh_mula',
        'tarikh_tamat',
        'emel_tamat',
        'sem_semasa',
        'sumber_biaya',
        'sumber_lain',
        'nama_penaja',
        'penaja_lain',
        'status',
    ];

    public function infoipt()
    {
        return $this->hasOne(InfoIpt::class, 'id_institusi', 'id_institusi');
    }

    public function peringkat()
    {
        return $this->belongsTo(PeringkatPengajian::class, 'peringkat_pengajian', 'kod_peringkat');
    }


}
