<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saringan extends Model
{
    use HasFactory;
    protected $table = 'permohonan_saringan';

    protected $fillable = [
        'permohonan_id',
        'no_rujukan_permohonan',
        'catatan_profil_diri',
        'catatan_akademik',
        'catatan_salinan_dokumen',
    ];
}
