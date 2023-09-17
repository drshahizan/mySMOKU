<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuntutan extends Model
{
    use HasFactory;
    protected $table = 'tuntutan'; 

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
