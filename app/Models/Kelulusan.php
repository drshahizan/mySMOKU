<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'permohonan_kelulusan';

    protected $fillable = [
        'permohonan_id',
        'no_mesyuarat',
        'tarikh_mesyuarat',
        'keputusan',
        'catatan',
    ];
}
