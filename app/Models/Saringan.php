<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Saringan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'saringan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_permohonan',
        'catatan_profilDiri',
        'catatan_akademik',
        'catatan_salinanDokumen',
    ];
}
