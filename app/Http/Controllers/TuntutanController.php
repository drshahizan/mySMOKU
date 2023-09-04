<?php

namespace App\Http\Controllers;
use App\Models\Tuntutan;
use App\Models\TuntutanPermohonan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TuntutanController extends Controller
{
    public function borangTuntutanYuran()
    {   
        $tuntutan = Tuntutan::all()->where('nokp_pelajar', Auth::user()->nokp);
        return view('pages.tuntutan.borangtuntutanyuran', compact('tuntutan'));
        
    }

    public function savetuntutan(Request $request)
    {   
        
        $data=new tuntutan();
        
            $sesi=$request->sesi;
            $sem=$request->semester; 
            $resit=$request->resit; 
            $nokp = Auth::user()->nokp;

            $wordlist = Tuntutan::where('nokp_pelajar', '<=', $nokp)->get();
            $wordCount = $wordlist->count();
            $running_num =  $wordCount + 1;

            //dd($running_num);
            $name1='resit';  
            //$filenamekepPeperiksaan=$name1.'-'.$sesi.'_'.$sem.'.'.$kepPeperiksaan->getClientOriginalExtension();
            $filenameresit=$name1.'-'.$nokp.'_'.$running_num.'.'.$resit->getClientOriginalExtension();
            //dd($request->filenamekepPeperiksaan);
            $request->resit->move('assets/dokumen/tuntutan',$filenameresit);
            $permohonan = TuntutanPermohonan::all()->where('nokp_pelajar', '=', $nokp)->first();
            $idmohon =  $permohonan->id_permohonan;
            //dd($idmohon);
            
            $data->id_tuntutan=$idmohon.'/'.$running_num;
            $data->id_permohonan=$idmohon;
            $data->nokp_pelajar=$nokp;
            $data->sesi=$request->sesi;
            $data->semester=$request->semester;
            $data->yuran=$request->jenis_yuran;
            $data->no_resit=$request->no_resit;
            $data->resit=$filenameresit;


            

            $data->save();




        return redirect()->route('borangTuntutanYuran')->with('message', 'saveeeeeeeee.');

    }
}
