<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenESP extends Model
{
    use HasFactory;
    protected $table = 'dokumen_esp'; 

    protected $fillable = [
        'id_dokumen',
        'dokumen',
        'catatan',
    ];
}