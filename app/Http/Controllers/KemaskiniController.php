<?php

namespace App\Http\Controllers;

use App\Models\EmelKemaskini;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class KemaskiniController extends Controller
{
    public function senaraiEmel(){
        return view('kemaskini.sekretariat.emel.senarai_emel');
    }

    public function kemaskiniTidakLayakBKOKU(){
        $emel = EmelKemaskini::where('emel_id',6)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }
    public function kemaskiniLayakBKOKU(){
        $emel = EmelKemaskini::where('emel_id',5)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
    }
    public function kemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('emel_id',4)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }
    public function pKemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('emel_id',1)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan',compact('emel'));
    }
    public function kemaskiniTidakLayakPPK(){
        $emel = EmelKemaskini::where('emel_id',6)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }
    public function kemaskiniLayakPPK(){
        $emel = EmelKemaskini::where('emel_id',5)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_layak',compact('emel'));
    }
    public function kemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('emel_id',4)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }
    public function pKemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('emel_id',1)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_dikembalikan',compact('emel'));
    }

    public function kemaskiniEmel(Request $request, $id){
        $emel = EmelKemaskini::where('emel_id',$id)->first();
        EmelKemaskini::where('emel_id', $id)
            ->update([
                'subjek'            => $request->get('subjek'),
                'pendahuluan'       => $request->get('pendahuluan'),
                'isi_kandungan'     => $request->get('isi_kandungan'),
                'penutup'           => $request->get('penutup'),
                'disediakan_oleh'   => $request->get('d_oleh'),
            ]);

        if($emel->emel_id == 1){
            $emel = EmelKemaskini::where('emel_id',1)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->emel_id == 2){
            $emel = EmelKemaskini::where('emel_id',2)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->emel_id == 3){
            $emel = EmelKemaskini::where('emel_id',3)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
        }
        if($emel->emel_id == 4){
            $emel = EmelKemaskini::where('emel_id',4)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
        }
        if($emel->emel_id == 5){
            $emel = EmelKemaskini::where('emel_id',5)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
        }
        if($emel->emel_id == 6){
            $emel = EmelKemaskini::where('emel_id',6)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
        }
    }
}
