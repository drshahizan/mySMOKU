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
        'smoku_id',
        'permohonan_id',
        'no_rujukan_tuntutan',
        'sesi',
        'semester',
        'yuran',
        'wang_saku',
        'amaun_wang_saku',
        'yuran_disokong',
        'yuran_dibayar',
        'wang_saku_disokong',
        'wang_saku_dibayar',
        'jumlah',
        'baki',
        'baki_disokong',
        'baki_dibayar',
        'catatan_dibayar',
        'tarikh_hantar',
        'status',

    ];
}
