<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Permohonan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'pelajar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelajar',
        'nokp_pelajar',
        'noJKM',
        'tkh_lahir',
        'umur',
        'bangsa',
        'jantina',
        'kecacatan',
        'alamat1',
        //'alamat2',
        //'alamat3',
        //'alamat_poskod',
		//'alamat_bandar',
        //'alamat_negeri',
        'dun',
        'parlimen',
        'alamat_surat1',
        //'alamat_surat2',
        //'alamat_surat3',
        'alamat_surat_poskod',
        'alamat_surat_bandar',
        'alamat_surat_negeri',
        'no_telR',
        'no_tel',
        'emel',
        'no_akaunbank',
        
    ];

    

    
}
