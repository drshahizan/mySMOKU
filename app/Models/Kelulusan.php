<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;
    protected $table = 'permohonan_kelulusan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_permohonan',
        'no_mesyuarat',
        'tarikh_mesyuarat',
        'keputusan',
        'catatan',
    ];
}
