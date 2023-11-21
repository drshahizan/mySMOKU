<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dun extends Model
{
    use HasFactory;
    protected $table = 'bk_dun';

    protected $fillable = [
        'id',
        'parlimen_id',
        'kod_dun',
        'dun',
    ];
}
