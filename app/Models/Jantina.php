<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jantina extends Model
{
    use HasFactory;
    protected $table = 'bk_jantina';

    protected $fillable = [
        'kod_jantina',
        'jantina',
    ];
}
