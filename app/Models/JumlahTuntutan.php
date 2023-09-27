<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahTuntutan extends Model
{
    use HasFactory;
    protected $table = 'bk_jumlah_tuntutan';

    protected $fillable = [
        'program',
        'jenis',
        'semester',
        'jumlah',
    ];
}
