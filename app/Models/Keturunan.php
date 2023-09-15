<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keturunan extends Model
{
    use HasFactory;
    protected $table = 'bk_keturunan';

    protected $fillable = [
        'kod_keturunan',
        'keturunan',
    ];
}
