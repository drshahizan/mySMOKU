<?php

namespace App\Http\Controllers;
use App\Models\Tuntutan;
use App\Models\TuntutanPermohonan;
use App\Models\Status;
use App\Models\StatusTuntutan;

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
        
        //$data=new tuntutan();

            $nokp = Auth::user()->nokp;
            $permohonan = TuntutanPermohonan::all()->where('nokp_pelajar', '=', $nokp)->first();
            $idmohon =  $permohonan->id_permohonan;
            $resit=$request->resit; 
            
            $wordlist = Tuntutan::where('nokp_pelajar', '<=', $nokp)->get();
            $wordCount = $wordlist->count();
            //$running_num =  $wordCount + 1; //sebab nak guna satu id je
            $running_num =  2; // try duluuu


            foreach($resit as $img) {
				// Upload Orginal Image    
                $name1='resit';          
                $filenameresit =$name1.'-'.$nokp.'_'.$running_num.'_'.$img->getClientOriginalName();
                $img->move('assets/dokumen/tuntutan',$filenameresit);
                // Save In Database
                $data=new tuntutan();
                $data->id_tuntutan=$idmohon.'/'.$running_num;
                $data->id_permohonan=$idmohon;
                $data->nokp_pelajar=$nokp;
                $data->sesi=$request->sesi;
                $data->nota_resit=$request->nota_resit;
                $data->amaun=$request->amaun_yuran;
                $data->semester=$request->semester;
                $data->yuran=$request->jenis_yuran;
                $data->no_resit=$request->no_resit;
                $data->resit=$filenameresit;
                $data->status=1;

                $data->save();
			}

            $statustransaksi = StatusTuntutan::where('nokp_pelajar', '=', $nokp)->first();
            if ($statustransaksi === null) {
            $statustransaksi = StatusTuntutan::create([
                'id_tuntutan' => $idmohon.'/'.$running_num,
                'nokp_pelajar' => $nokp,
                'status' => '1',
        
                ]);
            }else {

            DB::table('statustransaksituntutan')->where('nokp_pelajar' ,$nokp)
                ->update([
                'id_tuntutan' => $idmohon.'/'.$running_num,
                'nokp_pelajar' => $nokp,
                'status' => '1',
                
            ]);
            }
            
            $statustransaksi->save();
            
            




        return redirect()->route('borangTuntutanYuran')->with('message', 'saveeeeeeeee.');

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
        
        $user = StatusTuntutan::create([
            'id_tuntutan' => $idtuntutan,
            'nokp_pelajar' => $nokp,
            'status' => '2',
    
        ]);
        $user->save();
        
        return redirect()->route('dashboard')->with('message', 'Tuntutan anda telah dihantar.');

    }
}
