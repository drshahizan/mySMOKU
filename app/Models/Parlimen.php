<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parlimen extends Model
{
    use HasFactory;
    protected $table = 'bk_parlimen';

    protected $fillable = [
        'id',
        'negeri_id',
        'kod_parlimen',
        'parlimen',
    ];
}
