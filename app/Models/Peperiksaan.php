<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Peperiksaan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'peperiksaan';
    public $directory="public/dokumen/peperiksaan/";  

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nokp_pelajar',
        'sesi',
        'semester',
        'cgpa',
        'kepPeperiksaan',

    ];

    public function getPathAttribute($value)  
    {  
    return $this->directory.$value;  
    }  

    
}
