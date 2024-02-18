<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahPeruntukan extends Model
{
    use HasFactory;

    protected $table = 'bk_jumlah_peruntukan';

    protected $fillable = [
        'tarikh_mula',
        'tarikh_tamat',
        'jumlahBKOKU',
        'jumlahPPK',
    ];
}
