<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peperiksaan extends Model
{
    use HasFactory;
    protected $table = 'permohonan_peperiksaan';
    
    protected $fillable = [
        'permohonan_id',
        'sesi',
        'semester',
        'cgpa',
        'pengesahan_rendah',
        'kepPeperiksaan',
        'nota_kepPeperiksaan',
    ];
}
