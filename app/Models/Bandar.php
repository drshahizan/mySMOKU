<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandar extends Model
{
    use HasFactory;
    protected $table = 'bk_bandar';

    protected $fillable = [
        'id',
        'bandar',
        'negeri_id',
    ];
}
