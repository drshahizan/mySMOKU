<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeringkatPengajian extends Model
{
    use HasFactory;
    protected $table = 'bk_peringkat_pengajian';

    protected $fillable = [
        'kod_peringkat',
        'kod_esp',
        'peringkat',
        
    ];
}
