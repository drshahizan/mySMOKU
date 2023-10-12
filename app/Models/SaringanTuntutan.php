<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaringanTuntutan extends Model
{
    use HasFactory;

    protected $table = 'tuntutan_saringan';

    protected $fillable = [
        'tuntutan_id',
        'saringan_kep_peperiksaan',
        'catatan',
        'status',
    ];
}
