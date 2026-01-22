<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButiranPelajar extends Model
{
    use HasFactory;
    protected $table = 'smoku_butiran_pelajar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'smoku_id',
        'alamat_tetap_negeri',
        'alamat_tetap_bandar',
        'alamat_tetap_poskod',
        'parlimen',
        'dun',
        'alamat_surat_menyurat',
        'alamat_surat_negeri',
        'alamat_surat_bandar',
        'alamat_surat_poskod',
        'tel_bimbit',
        'tel_rumah',
        'emel',
        'no_akaun_bank',
        
    ];

    public function smoku()
    {
        return $this->belongsTo(Smoku::class, 'smoku_id', 'id');
    }

    public function waris()
    {
        return $this->hasOne(Waris::class, 'smoku_id', 'smoku_id');
    }

    public function akademik()
    {
        return $this->hasOne(Akademik::class, 'smoku_id', 'smoku_id')
            ->where('status', 1)
            ->orderByDesc('id');
    }

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'smoku_id', 'smoku_id');
    }

    public function negeri()
    {
        return $this->belongsTo(Negeri::class, 'alamat_tetap_negeri');
    }

    public function bandar()
    {
        return $this->belongsTo(Bandar::class, 'alamat_tetap_bandar');
    }

    public function parlimenRelation()
    {
        return $this->belongsTo(Parlimen::class, 'parlimen', 'id');
    }

    public function dunRelation()
    {
        return $this->belongsTo(Dun::class, 'dun', 'id');
    }

    public function agamaRelation()
    {
        return $this->belongsTo(Agama::class, 'agama', 'id');
    }


}
