<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'permohonan_dokumen'; 

    protected $fillable = [
        'permohonan_id',
        'id_dokumen',
        'dokumen',
        'catatan',
    ];
}
