<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarikhIklan extends Model
{
    use HasFactory;
    protected $table = 'bk_tarikh_iklan';

    protected $fillable = [
        'tarikh_mula',
        'masa_mula',
        'tarikh_tamat',
        'masa_tamat',
        'catatan',
    ];
}
