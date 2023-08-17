<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyelarasController extends Controller
{
    public function keseluruhanTuntutan()
    {
        return view('pages.penyelaras.tuntutan.keseluruhan');
    }

    public function tuntutanBaru()
    {
        return view('pages.penyelaras.tuntutan.baru');
    }

    public function keputusanTuntutan()
    {
        return view('pages.penyelaras.tuntutan.keputusan');
    }

}
