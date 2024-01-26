<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarInstitusi extends Model
{
    use HasFactory;
    protected $table = 'tukar_institusi'; 

    protected $fillable = [
        'smoku_id',
        'id_institusi',
        'id_institusi_baru',
        'status',
    ];
}
