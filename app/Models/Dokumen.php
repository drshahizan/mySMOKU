<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Dokumen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'dokumen';
    public $directory="public/dokumen/";  

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_permohonan',
        'nokp_pelajar',
        'suratTawaran',
        'nota_suratTawaran',
        'akaunBank',
        'nota_akaunBank',
        'kepPeperiksaan',
        'nota_kepPeperiksaan',
        'invoisResit',
        'nota_invoisResit',
    ];

    public function getPathAttribute($value)  
    {  
    return $this->directory.$value;  
    }  

    
}
