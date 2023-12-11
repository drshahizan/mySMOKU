<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaklumatBank extends Model
{
    use HasFactory;
    protected $table = 'maklumat_bank';

    protected $fillable = [
        'institusi_id',
        'bank_id',
        'nama_akaun',
        'no_akaun',
        'penyata_bank',
    ];
}
