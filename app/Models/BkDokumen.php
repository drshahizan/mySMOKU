<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkDokumen extends Model
{
    use HasFactory;

    protected $table = 'bk_dokumen';

    protected $fillable = [
        'kod_dokumen',
        'nama_dokumen',
        'input_name',
        'jenis_dokumen',
        'contoh_path',
        'status',
        'susunan',
    ];
}
