<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KemaskiniController extends Controller
{
    public function senaraiEmel(){
        return view('kemaskini.sekretariat.emel.senarai_emel');
    }

    public function kemaskiniTidakLayakBKOKU(){
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak');
    }
    public function kemaskiniLayakBKOKU(){
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak');
    }
    public function kemaskiniDikembalikanBKOKU(){
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan');
    }
    public function pKemaskiniDikembalikanBKOKU(){
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan');
    }
    public function kemaskiniTidakLayakPPK(){
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_tidak_layak');
    }
    public function kemaskiniLayakPPK(){
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_layak');
    }
    public function kemaskiniDikembalikanPPK(){
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_dikembalikan');
    }
    public function pKemaskiniDikembalikanPPK(){
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_dikembalikan');
    }
}
