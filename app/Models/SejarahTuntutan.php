<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected static function booted()
    {
        static::saving(function ($sejarahTuntutan) {
            if (blank($sejarahTuntutan->dilaksanakan_oleh) && Auth::check()) {
                $sejarahTuntutan->dilaksanakan_oleh = Auth::id();
            }
        });
    }
}
