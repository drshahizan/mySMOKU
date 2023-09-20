<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuntutanItem extends Model
{
    use HasFactory;
    protected $table = 'tuntutan_item'; 

    protected $fillable = [
        'id',
        'tuntutan_id',
        'jenis_yuran',
        'no_resit',
        'resit',
        'nota_resit',
        'amaun',

    ];
}
