<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaklumatKursusMQA extends Model
{
    use HasFactory;
    protected $table = 'bk_kursus_mqa';

    protected $fillable = [
        'institusi_id',
        'nama_akaun',
        'no_akaun',
    ];
}
