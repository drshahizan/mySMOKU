<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TangguhPengajian extends Model
{
    use HasFactory;
    protected $table = 'tangguh_pengajian'; 

    protected $fillable = [
        'smoku_id',
        'permohonan_id',
        'surat_tangguh',
        'dokumen_sokongan',
        'perakuan',
        'status',
    ];
}
