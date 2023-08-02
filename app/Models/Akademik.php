<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Akademik extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'maklumatakademik';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_pendaftaranpelajar',
        'nokp_pelajar',
        'peringkat_pengajian',
        'nama_kursus',
        'id_institusi',
        'tkh_mula',
        'tkh_tamat',
        'sem_semasa',
        'tempoh_pengajian',
        'bil_bulanpersem',
        'mod',
        'cgpa',
        'sumber_biaya',
        'nama_penaja',
        //'status',
        //'terimaHLP',
        //'tkh_maklumat',
        
        
    ];

    

    
}
