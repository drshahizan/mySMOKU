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
        'status',
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
        'no_baucer',
        'tarikh_baucer',
        'perihal',
        'sesi_bayaran',
        'no_cek',
        'tarikh_transaksi',
        'tarikh_hantar',
        'status_pemohon',
    ];
}
