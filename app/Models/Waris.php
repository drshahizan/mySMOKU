<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Waris extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'waris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_waris',
        'nokp_waris',
        'alamat1',
        //'alamat2',
        //'alamat3',
        'alamat_poskod',
        'alamat_bandar',
        'alamat_negeri',
        //'alamat_surat1',
        //'alamat_surat2',
        //'alamat_surat3',
        //'alamat_surat_poskod',
        //'alamat_surat_bandar',
        //'alamat_surat_negeri',
        'no_telR',
        'no_tel',
        'nokp_pelajar',
        'hubungan',
        'pendapatan',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    
}
