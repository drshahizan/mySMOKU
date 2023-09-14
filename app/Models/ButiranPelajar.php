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
        'alamat_surat',
        'alamat_surat_poskod',
        'alamat_surat_bandar',
        'alamat_surat_negeri',
        'no_tel_rumah',
        'no_tel_hp',
        'emel',
        'no_akaun_bank',
        
    ];
}
