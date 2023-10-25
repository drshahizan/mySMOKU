<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberBiaya extends Model
{
    use HasFactory;
    protected $table = 'bk_sumber_biaya';

    protected $fillable = [
        'kod_biaya',
        'biaya',
    ];
}
