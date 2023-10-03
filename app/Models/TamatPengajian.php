<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamatPengajian extends Model
{
    use HasFactory;
    protected $table = 'tamat_pengajian'; 

    protected $fillable = [
        'smoku_id',
        'sijil_tamat',
        'transkrip',
        'perakuan',
    ];
}
