<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenaraiBank extends Model
{
    use HasFactory;

    protected $table = 'senarai_bank';

    protected $fillable = [
        'kod_bank',
        'nama_bank',
    ];
}
