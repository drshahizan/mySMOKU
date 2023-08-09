<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Infoipt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Akademik;
//use DB;
use session;


class SemakUserController extends Controller
{
    public function create(Request $request)
    {
        $nokp = $request->session()->get('nokp');
        //dd($nokp);
        
        $ipt = Infoipt::all()->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');

        return view('pages.auth.semaksyarat', compact('ipt','peringkat','kursus'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'terimHLP' => ['required'],
            'cuti' => ['required'],
            'id_institusi' => ['required'],
            'peringkat_pengajian' => ['required'],
            'nama_kursus' => ['required'],
            
        ]);

            $terimHLP = $request->terimHLP;
            $cuti = $request->cuti;
            $id_institusi = $request->id_institusi;
            $peringkat_pengajian = $request->peringkat_pengajian;
            $nama_kursus = $request->nama_kursus;

            
            if ($terimHLP == 'ya') {
                return redirect()->route('login')
                ->with('message', 'Anda tidak layak daftar kerana anda penerima HLP');
                
            } else {

                $user = Akademik::create([
                    'nokp_pelajar' => $request->session()->get('nokp'),
                    'id_institusi' => $request->id_institusi,
                    'peringkat_pengajian' => $request->peringkat_pengajian,
                    'nama_kursus' => $request->nama_kursus,
                    
                ]);
                
                $user->save();

                return redirect()->route('daftarlayak');
            }

        

        
    }
    
}
