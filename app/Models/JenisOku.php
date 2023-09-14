<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisOku extends Model
{
    use HasFactory;
    protected $table = 'bk_jenisoku';

    protected $fillable = [
        'id',
        'kodoku',
        'jenisoku',
    ];
}
