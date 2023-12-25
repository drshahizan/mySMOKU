<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenESP extends Model
{
    use HasFactory;
    protected $table = 'dokumen_esp'; 

    protected $fillable = [
        'user_id',
        'institusi_id',
        'no_rujukan',
        'dokumen1',
        'dokumen1a',
        'dokumen2',
        'dokumen2a',
        'dokumen3',
        'dokumen4',
    ];
}
