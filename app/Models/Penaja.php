<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penaja extends Model
{
    use HasFactory;
    protected $table = 'bk_penaja';

    protected $fillable = [
        'kod_penaja',
        'penaja',
    ];
}
