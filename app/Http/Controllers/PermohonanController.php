<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        /*if (Auth::check())
        {
            $id = Auth::user()->id();
            return $id;
        }*/

        $pelajar = Permohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $waris = Waris::all()->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::all()->where('nokp_pelajar', Auth::user()->id());
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        if (!$tuntutanpermohonan->isEmpty())
        {
            return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan'));

        }
        else
        {
            return view('pages.permohonan.permohonan-baru');
        }
        //return view('pages.permohonan.permohonan-baru', compact('pelajar','waris','akademik','tuntutanpermohonan'));
        
    }


    public function store(Request $request)
    {   
        $request->session()->regenerate();
        $request->validate([
			'nama_pelajar' => 'required',
			'nokp_pelajar' => 'required|unique:pelajar',
			//'noJKM' => 'required',
            //'no_akaunbank' => 'required',
            //'emel' => 'required'
            
        ]);

        $user = Permohonan::create([
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
            'alamat_negeri' => $request->alamat_negeri,
            'dun' => $request->bandar,
            'no_tel' => $request->no_tel,
            'no_telR' => $request->no_telR,
            'no_akaunbank' => $request->no_akaunbank,
            'emel' => $request->emel,
   
        ]);

        $user = Waris::create([
            'nama_waris' => $request->nama_waris,
            'nokp_waris' => $request->nokp_waris,
            'alamat1' => $request->alamatW1,
            'alamat_poskod' => $request->alamatW_poskod,
            'alamat_bandar' => $request->alamatW_bandar,
            'alamat_negeri' => $request->alamatW_negeri,
            'no_tel' => $request->no_telW,
            'no_telR' => $request->no_telRW,
            'nokp_pelajar' => $request->nokp_pelajar,
            'hubungan' => $request->hubungan,
            'pendapatan' => $request->pendapatan,
    
        ]);

        $user = Akademik::create([
            'no_pendaftaranpelajar' => $request->no_pendaftaranpelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => $request->nama_kursus,
            'id_institusi' => $request->id_institusi,
            'tkh_mula' => $request->tkh_mula,
            'tkh_tamat' => $request->tkh_tamat,
            'sem_semasa' => $request->sem_semasa,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulanpersem' => $request->bil_bulanpersem,
            'cgpa' => $request->cgpa,
            'sumber_biaya' => $request->sumber_biaya,
            'nama_penaja' => $request->nama_penaja,
            'status' => '1',
<<<<<<< Updated upstream
            //'terimaHLP' => $request->terimaHLP,
            //'tkh_maklumat' => $request->tkh_maklumat,
=======
            //'terimaHLP' => $request->terimaHLP, 
            //'tkh_maklumat' => $request->tkh_maklumat, 
>>>>>>> Stashed changes
            
        ]);

        $user = TuntutanPermohonan::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'program' => 'BKOKU',
            'jenis_tuntutan' => $request->jenis_tuntutan,
            'amaun' => $request->amaun,
            'perakuan' => $request->perakuan,
            
        ]);
        
        $user->save();
        //return view('pages.dashboards.index'); // jadi yang ni kena return ke page view
        return redirect()->route('viewpermohonan');
        //return redirect()->back();

        // $request->session()->invalidate();
    }

    public function viewpermohonan(){
        $pelajar = Permohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $waris = Waris::all()->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::all()->where('nokp_pelajar', Auth::user()->id());
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan'));
        
    }




}


