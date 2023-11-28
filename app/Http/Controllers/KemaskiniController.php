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

    public function pKemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('id',1)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan',compact('emel'));
    }

    public function pKemaskiniLayakBKOKU(){
        $emel = EmelKemaskini::where('id',2)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_layak',compact('emel'));
    }

    public function pKemaskiniTidakLayakBKOKU(){
        $emel = EmelKemaskini::where('id',3)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_tidak_layak',compact('emel'));
    }

    public function kemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('id',4)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }

    public function kemaskiniLayakBKOKU(){
        $emel = EmelKemaskini::where('id',5)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
    }

    public function kemaskiniTidakLayakBKOKU(){
        $emel = EmelKemaskini::where('id',6)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }

    public function pKemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('id',7)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_dikembalikan',compact('emel'));
    }

    public function pKemaskiniLayakPPK(){
        $emel = EmelKemaskini::where('id',8)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_layak',compact('emel'));
    }

    public function pKemaskiniTidakLayakPPK(){
        $emel = EmelKemaskini::where('id',9)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_tidak_layak',compact('emel'));
    }

    public function kemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('id',10)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }

    public function kemaskiniLayakPPK(){
        $emel = EmelKemaskini::where('id',11)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_layak',compact('emel'));
    }

    public function kemaskiniTidakLayakPPK(){
        $emel = EmelKemaskini::where('id',12)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }
    
    public function kemaskiniEmel(Request $request, $id){
        $emel = EmelKemaskini::where('id',$id)->first();
        
        EmelKemaskini::where('id', $id)
            ->update([
                'subjek'            => $request->get('subjek'),
                'pendahuluan'       => $request->get('pendahuluan'),
                'isi_kandungan1'    => $request->get('isi_kandungan1'),
                'isi_kandungan2'    => $request->get('isi_kandungan2'),
                'penutup'           => $request->get('penutup'),
                'disediakan_oleh'   => $request->get('d_oleh'),
            ]);

        if($emel->id == 1){
            $emel = EmelKemaskini::where('id',1)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->id == 2){
            $emel = EmelKemaskini::where('id',2)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_layak',compact('emel'));
        }
        if($emel->id == 3){
            $emel = EmelKemaskini::where('id',3)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_tidak_layak',compact('emel'));
        }
        if($emel->id == 4){
            $emel = EmelKemaskini::where('id',4)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->id == 5){
            $emel = EmelKemaskini::where('id',5)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
        }
        if($emel->id == 6){
            $emel = EmelKemaskini::where('id',6)->first();
            return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
        }
        if($emel->id == 7){
            $emel = EmelKemaskini::where('id',7)->first();
            return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->id == 8){
            $emel = EmelKemaskini::where('id',8)->first();
            return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_layak',compact('emel'));
        }
        if($emel->id == 9){
            $emel = EmelKemaskini::where('id',9)->first();
            return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_tidak_layak',compact('emel'));
        }
        if($emel->id == 10){
            $emel = EmelKemaskini::where('id',10)->first();
            return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_dikembalikan',compact('emel'));
        }
        if($emel->id == 11){
            $emel = EmelKemaskini::where('id',11)->first();
            return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_layak',compact('emel'));
        }
        if($emel->id == 12){
            $emel = EmelKemaskini::where('id',12)->first();
            return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_tidak_layak',compact('emel'));
        }     
    }

    public function paparEmel($id){
        $emel = EmelKemaskini::where('id',$id)->first();
        return view('kemaskini.sekretariat.emel.papar_emel',compact('emel'));
    }
}
