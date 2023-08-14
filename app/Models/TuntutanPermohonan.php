<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class TuntutanPermohonan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'permohonan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_permohonan',
        'nokp_pelajar',
        'program',
        'yuran',
        'elaun',
        'amaun',
        'perakuan',
        
        
    ];

    

    
}
