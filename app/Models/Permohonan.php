<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $table = 'permohonan'; 

    protected $fillable = [
        'smoku_id',
        'no_rujukan_permohonan',        
        'program',
        'yuran',
        'amaun_yuran',
        'wang_saku',
        'amaun_wang_saku',
        'yuran_disokong',
        'yuran_dibayar',
        'wang_saku_disokong',
        'wang_saku_dibayar',
        'perakuan',
        'status',
    ];
}
