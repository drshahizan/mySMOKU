<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'permohonan_dokumen'; 

    protected $fillable = [
        'smoku_id',
        'no_rujukan_permohonan',
        'id_sekretariat',
        'suratTawaran',
        'nota_suratTawaran',
        'akaunBank',
        'nota_akaunBank',
        'kepPeperiksaan',
        'nota_kepPeperiksaan',
        'invoisResit',
        'nota_invoisResit',
    ];
}
