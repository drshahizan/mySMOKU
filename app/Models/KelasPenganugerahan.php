<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPenganugerahan extends Model
{
    use HasFactory;
    protected $table = 'bk_kelas_penganugerahan';

    protected $fillable = [
        'id',
        'kelas',
    ];
}
