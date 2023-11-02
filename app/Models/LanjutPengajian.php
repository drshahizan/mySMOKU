<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanjutPengajian extends Model
{
    use HasFactory;
    protected $table = 'lanjut_pengajian'; 

    protected $fillable = [
        'smoku_id',
        'permohonan_id',
        'surat_lanjut',
        'jadual',
        'dokumen_sokongan',
        'perakuan',
    ];
}
