<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisOku extends Model
{
    use HasFactory;
    protected $table = 'bk_jenis_oku';

    protected $fillable = [
        'id',
        'kod_oku',
        'kecacatan',
    ];
}
