<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PentadbirController extends Controller
{
    public function daftar()
    {
        return view('pages.pentadbir.daftarpengguna');
    }
}
