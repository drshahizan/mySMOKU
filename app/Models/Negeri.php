<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negeri extends Model
{
    use HasFactory;
    protected $table = 'bk_negeri';

    protected $fillable = [
        'id',
        'kod_negeri',
        'negeri',
    ];
}
