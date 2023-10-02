<?php

namespace App\Http\Controllers;
use App\Models\Tuntutan;
use App\Models\TuntutanItem;
use App\Models\Permohonan;
use App\Models\Smoku;
use App\Models\SejarahTuntutan;
use App\Models\Akademik;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TuntutanController extends Controller
{
    public function tuntutanBaharu()
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id',$smoku_id->id)->first();
        $tuntutan = Tuntutan::join('tuntutan_item','tuntutan_item.tuntutan_id','=','tuntutan.id')
        ->get(['tuntutan.*', 'tuntutan_item.*'])
        ->where('smoku_id', $smoku_id->id)
        //->where('permohonan_id', $permohonan->id)
        ->where('status', 1);
        $akademik = Akademik::where('smoku_id',$smoku_id->id)->first();
        
        return view('pages.tuntutan.borang_tuntutan', compact('permohonan','tuntutan','akademik'));
        
    }

    public function simpanTuntutan(Request $request)
    {   
        
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        $biltuntutan = Tuntutan::where('smoku_id', '<=', $smoku_id->id)
            ->groupBy('no_rujukan_tuntutan')
            ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
            ->get();

        $bil = $biltuntutan->count();
        $running_num =  $bil + 1; //sebab nak guna satu id je
        $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();
        if ($tuntutan === null) {
            $tuntutan = Tuntutan::create([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,
                'yuran' => '1',
                'status' => '1',
            ]);
        }
       /*else {
            Tuntutan::where('smoku_id', '=', $smoku_id->id)
                ->where('permohonan_id', '=', $permohonan->id)
                ->update([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,
                'status' => '1',
                
            ]);

        }*/

        $tuntutan->save();

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();

        $resit = $request->resit;
        $counter = 1; 

        foreach($resit as $resit) {
                     
            $filenameresit =$resit->getClientOriginalName();
            $uniqueFilename = $counter . '_' . $filenameresit;

            // Append increment to the filename until it's unique
            while (file_exists('assets/dokumen/tuntutan/' . $uniqueFilename)) {
                $counter++;
                $uniqueFilename = $counter . '_' . $filenameresit;
            }
            $resit->move('assets/dokumen/tuntutan',$uniqueFilename);

            $data=new tuntutanitem();
            $data->tuntutan_id=$tuntutan->id;
            $data->jenis_yuran=$request->jenis_yuran;
            $data->no_resit=$request->no_resit;
            $data->resit=$uniqueFilename;
            $data->nota_resit=$request->nota_resit;
            $data->amaun=$request->amaun_yuran;
            $data->save();

            $counter++;
        }

            
        //simpan dalam table sejarah_tuntutan
        $sejarahtuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)->first();
        if ($sejarahtuntutan === null) {
            $sejarahtuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $smoku_id->id,
                'status' => '1',
        
            ]);

        }else{

            SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)
                ->update([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $smoku_id->id,
                'status' => '1',
                
            ]);
        }
        
        $sejarahtuntutan->save();
            
        return redirect()->route('tuntutan.baharu')->with('message', 'simpan.');

    }

    public function hantarTuntutan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();

        $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)->first();
        if ($tuntutan != null) {
            Tuntutan::where('smoku_id' ,$smoku_id->id)
            ->update([

            'wang_saku' => $request->wang_saku,
            'amaun_wang_saku' => $request->amaun_wang_saku,
            'jumlah' => $request->jumlah,
            'status' => '2',
            
        ]);
        }
        $tuntutan->save();

        //simpan dalam table tuntutan_item
        // $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
        //     //->where('permohonan_id', '=', $permohonan->id) //salah ni
        //     ->first();
        
        $user = SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $smoku_id->id,
            'status' => '2',
    
        ]);
        $user->save();
        
        return redirect()->route('dashboard')->with('message', 'Tuntutan anda telah dihantar.');

    }
}
