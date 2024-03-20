<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Akademik;
use App\Models\Smoku;
use App\Models\Permohonan;

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
        'no_cek',
        'tarikh_transaksi',
        'tarikh_hantar',
        'status_pemohon',
        'sesi_bayaran',
        'data_migrate',
    ];

    public function akademik()
    {
        return $this->hasOne(Akademik::class, 'smoku_id', 'smoku_id');
    }

    public function smoku()
    {
        return $this->belongsTo(Smoku::class, 'smoku_id', 'id');
    }

    public function permohonan()
    {
        return $this->hasOne(Permohonan::class, 'id', 'permohonan_id');
    }

    
}
