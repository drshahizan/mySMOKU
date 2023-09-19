<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Smoku;


class PenyelarasPPKController extends Controller
{
    public function index()
    {
        $smoku = Smoku::orderBy('smoku.id','desc')
            ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
            ->leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
            ->get(['smoku.*', 'smoku_penyelaras.*', 'permohonan.*'])
            ->where('penyelaras_id','=', Auth::user()->id)
            ->where('status','!=', '2');
        //dd($smoku);    

        return view('dashboard.penyelaras_ppk.dashboard', compact('smoku'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kp' => ['required', 'string'],
        ]);

        $smoku=Smoku::where([['no_kp', '=', $request->no_kp]])->first();

        if ($smoku != null) {
                DB::table('smoku_penyelaras')->insert([
                    'smoku_id' => $smoku->id,
                    'penyelaras_id' => Auth::user()->id,
                    'status' => '1',
                    'created_at' => now(), // sebab tak guna model
                    'updated_at' => now(),
                ]);
                
                $id =  $smoku->id;
                $no_kp =  $smoku->no_kp;
                $smoku_id = $request->session()->put('id',$id);
                $no_kp = $request->session()->put('no_kp',$no_kp);
                return redirect()->route('penyelaras.dashboard')->with($smoku_id,$no_kp)
                ->with('message', $no_kp. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } 
            else {
                $nokp_in = $request->nokp;
                return redirect()->route('penyelaras.dashboard')
                ->with('xmessage', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }
    }
}
