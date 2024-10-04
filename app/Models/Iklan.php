<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    use HasFactory;
    protected $table = 'bk_iklan';

    protected $fillable = [
        'kategori_iklan',
        'tarikh_iklan',
        'tajuk_iklan',
        'status',
        'iklan',
    ];
}
