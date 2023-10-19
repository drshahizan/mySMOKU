<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmelKemaskini extends Model
{
    use HasFactory;

    protected $table = 'emel_kemaskini';

    protected $fillable = [
        'emel_id',
        'subjek',
        'pendahuluan',
        'isi_kandungan1',
        'isi_kandungan2',
        'penutup',
        'disediakan_oleh',
    ];
}
