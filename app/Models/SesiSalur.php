<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiSalur extends Model
{
    use HasFactory;
    protected $table = 'bk_sesi_salur';

    protected $fillable = [
        'sesi',
        'dilaksanakan_oleh',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dilaksanakan_oleh', 'id');
    }
}
