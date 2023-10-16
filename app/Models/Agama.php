<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'bk_agama';

    protected $fillable = [
        'id',
        'kod_agama',
        'agama',
    ];
}
