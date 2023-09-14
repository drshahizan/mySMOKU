<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoIpt extends Model
{
    use HasFactory;
    protected $table = 'bk_info_institusi';

    protected $fillable = [
        'id_institusi',
        'jenis_isntitusi',
        'nama_institusi',
    ];
}
