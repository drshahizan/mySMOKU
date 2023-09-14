<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberBiaya extends Model
{
    use HasFactory;
    protected $table = 'bk_sumberbiaya';

    protected $fillable = [
        'kodbiaya',
        'biaya',
    ];
}
