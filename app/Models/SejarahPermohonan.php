<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SejarahPermohonan extends Model
{
    use HasFactory;
    protected $table = 'sejarah_permohonan';

    protected $fillable = [
        'smoku_id',
        'permohonan_id',
        'status',
        'dilaksanakan_oleh',
    ];

    public function pelaksana()
    {
        return $this->belongsTo(User::class, 'dilaksanakan_oleh', 'id');
    }

    protected static function booted()
    {
        static::saving(function ($sejarahPermohonan) {
            if (blank($sejarahPermohonan->dilaksanakan_oleh) && Auth::check()) {
                $sejarahPermohonan->dilaksanakan_oleh = Auth::id();
            }
        });
    }
}
