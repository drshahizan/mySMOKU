<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuntutanBantuan extends Model
{
    use HasFactory;
    protected $table = 'tuntutan_bantuan'; 

    protected $fillable = [
        'id',
        'no_rujukan_tuntutan',
        'smoku_id',
        'jenis_yuran',
        'no_resit',
        'resit',
        'nota_resit',
        'amaun',
        'baki',
        'sesi',
        'semester',
        'status',

    ];
}
