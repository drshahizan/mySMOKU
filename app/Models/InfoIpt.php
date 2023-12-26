<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoIpt extends Model
{
    use HasFactory;
    protected $table = 'bk_info_institusi';

    protected $fillable = [
        'id_institusi',
        'institusi_esp',
        'nama_institusi',
        'nama_institusi_bi',
        'poskod',
        'jenis_institusi',
        'jenis_permohonan',
    ];
}
