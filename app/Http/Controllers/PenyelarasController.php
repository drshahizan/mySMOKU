<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smoku;
use DB;
//use session;

class PenyelarasController extends Controller
{
    public function create()
    {   
        $smoku = Smoku::all()->where('jenis','=', 'IPTA');
        return view('pages.penyelaras.dashboard', compact('smoku'));

        
    }
    public function store(Request $request)
    {

        
        $request->validate([
            'nokp' => ['required', 'string'],
            
        ]);

        //$nokp_in = $request->nokp;
        $nokp_smoku=Smoku::where([
            ['nokp', '=', $request->nokp],
            ])->first();

            
            if ($nokp_smoku != null) {
                DB::table('smoku')->where('nokp' ,$request->nokp)->update([

                'verify'=>'1',
                'jenis'=>'IPTA',
    
                ]);

                /*$user = Permohonan::create([
                    'nama_pelajar' => $request->nama_pelajar,
                    'nokp_pelajar' => $request->nokp_pelajar,
                    'tkh_lahir' => $request->tkh_lahir,
                    'umur' => $request->umur,
                    'jantina' => $request->jantina,
                    'noJKM' => $request->noJKM,
                    'kecacatan' => $request->kecacatan,
                    'bangsa' => $request->bangsa,
                    'alamat1' => $request->alamat1,
                    'alamat_poskod' => $request->alamat_poskod,
                    'alamat_bandar' => $request->alamat_bandar,
                    'alamat_negeri' => $request->alamat_negeri,
                    'no_tel' => $request->no_tel,
                    'no_telR' => $request->no_telR,
                    'no_akaunbank' => $request->no_akaunbank,
                    'emel' => $request->emel,
           
                ]);*/

                //return view('pages.auth.semaksyarat');
                $nokp_in = $request->nokp;
                $nokp = $request->session()->put('nokp',$nokp_in);
                //dd($nokp_in);
                return redirect()->route('dashboardpenyelaras')->with($nokp)
                ->with('message', $nokp_in. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } else {

                $nokp_in = $request->nokp;
                //return view('pages.auth.login')->with('successMsg','Maklumat anda tiada dalam semakkan SMOKU');
                return redirect()->route('dashboardpenyelaras')
                ->with('xmessage', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }


    }

    public function tuntutanWangSaku()
    {
        return view('pages.penyelaras.tuntutan.wangSaku');
    }

    public function maklumatTuntutanWangSaku()
    {
        return view('pages.penyelaras.tuntutan.maklumatWangSaku');
    }

    public function tuntutanYuranPengajian()
    {
        return view('pages.penyelaras.tuntutan.yuranPengajian');
    }

    public function maklumatTuntutanYuranPengajian()
    {
        return view('pages.penyelaras.tuntutan.maklumatYuranPengajian');
    }

    public function kemaskiniTuntutan()
    {
        return view('pages.penyelaras.tuntutan.kemaskini');
    }

    public function sejarahTuntutan()
    {
        return view('pages.penyelaras.tuntutan.sejarah');
    }

    public function permohonanbaru()
    {
        return view('pages.penyelaras.permohonan.permohonanbaru');
    }

    public function keseluruhanPermohonan()
    {
        return view('pages.penyelaras.permohonan.keseluruhanmohon');
    }

}
