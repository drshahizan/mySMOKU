<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahTuntutan extends Model
{
    use HasFactory;
    protected $table = 'sejarah_tuntutan';

    protected $fillable = [
        'smoku_id',
        'tuntutan_id',
        'status',
        'dilaksanakan_oleh',
    ];
}
