<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KemaskiniController extends Controller
{
    public function kemaskiniTidakLayak(){
        return view('kemaskini.sekretariat.emel.tuntutan.kemaskini_tidak_layak');
    }
}
