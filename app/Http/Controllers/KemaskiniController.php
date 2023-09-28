<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KemaskiniController extends Controller
{
    public function senaraiEmel(){
        return view('kemaskini.sekretariat.emel.senarai_emel');
    }

    public function kemaskiniTidakLayak(){
        return view('kemaskini.sekretariat.emel.tuntutan.kemaskini_tidak_layak');
    }
    public function kemaskiniLayak(){
        return view('kemaskini.sekretariat.emel.tuntutan.kemaskini_layak');
    }
    public function kemaskiniDikembalikan(){
        return view('kemaskini.sekretariat.emel.tuntutan.kemaskini_dikembalikan');
    }
    public function pKemaskiniDikembalikan(){
        return view('kemaskini.sekretariat.emel.permohonan.kemaskini_dikembalikan');
    }
}
