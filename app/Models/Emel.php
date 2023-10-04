<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emel extends Model
{
    use HasFactory;

    protected $table = 'bk_emel';

    protected $fillable = [
        'jenis_emel',
    ];
}
