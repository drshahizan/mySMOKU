<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaklumatKementerian extends Model
{
    use HasFactory;
    protected $table = 'bk_maklumat_kementerian';

    protected $fillable = [
        'nama_kementerian_bm',
        'nama_kementerian_bi',
        'nama_bahagian_bm',
        'nama_bahagian_bi',
        'alamat1',
        'alamat2',
        'poskod',
        'negeri',
        'negara',
        'tel',
        'hotline',
        'faks',
    ];
}
