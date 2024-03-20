<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Akademik;
use App\Models\Smoku;
use App\Models\Tuntutan;
use App\Models\Kelulusan;

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
        'baki_dibayar',
        'catatan_disokong',
        'catatan_dibayar',
        'no_baucer',
        'tarikh_baucer',
        'perihal',
        'no_cek',
        'perakuan',
        'tarikh_hantar',
        'status',
        'status_pemohon',
        'sesi_bayaran',
        'data_migrate',
    ];

    // Define the relationship with Akademik
    public function akademik()
    {
        return $this->hasOne(Akademik::class, 'smoku_id', 'smoku_id');
    }

    public function smoku()
    {
        return $this->belongsTo(Smoku::class, 'smoku_id', 'id');
    }

    public function tuntutan()
    {
        // Define the relationship with the Tuntutan model
        // Select only the latest record for each smoku_id
        return $this->hasOne(Tuntutan::class)->latest();
    }

    public function tuntutanAll()
    {
        return $this->hasMany(Tuntutan::class, 'id', 'permohonan_id');
    }

    public function kelulusan()
    {
        return $this->belongsTo(Kelulusan::class, 'id', 'permohonan_id');
    }

   
}
