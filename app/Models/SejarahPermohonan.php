<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahPermohonan extends Model
{
    use HasFactory;
    protected $table = 'sejarah_permohonan';

    protected $fillable = [
        'smoku_id',
        'permohonan_id',
        'status',
        'dilaksanakan_oleh',
    ];
}
