<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyelarasController extends Controller
{
    public function keseluruhanTuntutan()
    {
        return view('pages.saringan.salinanAkademik');
    }

    public function tuntutanBaru()
    {
        return view('pages.saringan.salinanAkademik');
    }

    public function keputusanTuntutan()
    {
        return view('pages.saringan.salinanAkademik');
    }

}
