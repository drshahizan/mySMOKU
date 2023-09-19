<?php

namespace App\Http\Controllers;
use App\Models\Tuntutan;
use App\Models\Permohonan;
use App\Models\Smoku;
use App\Models\SejarahTuntutan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TuntutanController extends Controller
{
    public function tuntutanBaharu()
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $tuntutan = Tuntutan::all()->where('smoku_id', $smoku_id->id);
        return view('pages.tuntutan.borangtuntutanyuran', compact('tuntutan'));
        
    }

    public function simpanTuntutan(Request $request)
    {   
        
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $id = $smoku_id->id;
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $idmohon = $permohonan->id;
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;
        //dd($no_rujukan_permohonan);
        
        $resit = $request->resit; 
        
        $itemtututan = SejarahTuntutan::where('smoku_id', '<=', $id)
            ->groupBy('tuntutan_id')
            ->selectRaw('tuntutan_id, count(id) AS bilangan') 
            ->get();

        //dd($itemtututan);
        $wordCount = $itemtututan->count();
        $running_num =  $wordCount; //sebab nak guna satu id je
        //dd($running_num);
        $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu


        foreach($resit as $img) {
                     
            $filenameresit =$img->getClientOriginalName();
            $img->move('assets/dokumen/tuntutan',$filenameresit);
            // Save In Database
            $data=new tuntutan();
            $data->smoku_id=$id;
            $data->no_rujukan_tuntutan=$no_rujukan_tuntutan;
            $data->jenis_yuran=$request->jenis_yuran;
            $data->no_resit=$request->no_resit;
            $data->resit=$filenameresit;
            $data->nota_resit=$request->nota_resit;
            $data->amaun=$request->amaun_yuran;
            $data->sesi=$request->sesi;
            $data->semester=$request->semester;
            $data->status=1;

            $data->save();
        }

            $tuntutan = Tuntutan::where('smoku_id', '=', $id)->first();
            
            $tuntutan_id = $tuntutan->id;
            //dd($tuntutan_id);
            $statustuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan_id)->first();
            if ($statustuntutan === null) {
            $statustuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan_id,
                'smoku_id' => $id,
                'status' => '1',
        
                ]);
            }else {

            SejarahTuntutan::where('smoku_id' ,$id)
                ->update([
                'tuntutan_id' => $tuntutan_id,
                'smoku_id' => $id,
                'status' => '1',
                
            ]);
            }
            
            $statustuntutan->save();
            
        return redirect()->route('tuntutan.baharu')->with('message', 'simpan.');

    }

    public function hantartuntutan(Request $request)
    {   
        $nokp = Auth::user()->nokp;

        $tuntutan = Tuntutan::where('nokp_pelajar', '=', $nokp)->first();
        if ($tuntutan != null) {
            DB::table('maklumattuntutan')->where('nokp_pelajar' ,$nokp)
            ->update([
            
            //'perakuan' => $request->perakuan,
            'status' => '2',
            
        ]);
        }
        $tuntutan->save();

        //$tuntutan = Tuntutan::all()->where('nokp_pelajar', '=', $nokp)->first();
        $idtuntutan =  $tuntutan->id_tuntutan;
        //dd($idtuntutan);
        
        $user = SejarahTuntutan::create([
            'id_tuntutan' => $idtuntutan,
            'nokp_pelajar' => $nokp,
            'status' => '2',
    
        ]);
        $user->save();
        
        return redirect()->route('dashboard')->with('message', 'Tuntutan anda telah dihantar.');

    }
}
