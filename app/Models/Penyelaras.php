<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelaras extends Model
{
    use HasFactory;
    protected $table = 'smoku_penyelaras';

    protected $fillable = [
        'smoku_id',
        'penyelaras_id',
        'status',
    ];
}
