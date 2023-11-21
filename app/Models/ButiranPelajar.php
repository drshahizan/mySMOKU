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
}
