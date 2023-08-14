<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\User;
use App\Models\Smoku;
use App\Models\Infoipt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\Sumberbiaya;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use DB;

class PermohonanController extends Controller
{
    public function permohonan()
    {

        $smoku = Smoku::join('bk_jantina','bk_jantina.kodjantina','=','smoku.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'smoku.bangsa')
        ->join('bk_hubungan','bk_hubungan.kodhubungan','=','smoku.hubungan')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_bangsa.*', 'bk_hubungan.*'])
        ->where('nokp', Auth::user()->id());
        $infoipt = Infoipt::all()->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kodmod');
        $biaya = Sumberbiaya::all()->sortBy('kodbiaya');

        $pelajar = Permohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $waris = Waris::all()->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        //return $akademik;
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $status = Status::all()->where('nokp_pelajar', Auth::user()->id());
        if (!$status->isEmpty())
        {
            return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan'));

        }
        else
        {
            //return view('pages.permohonan.permohonan-baru');
            return view('pages.permohonan.permohonan-baru', compact('smoku','akademik','infoipt','peringkat','kursus','mod','biaya'));
        }
        
        
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
            'alamat_bandar' => $request->alamat_bandar,
            'alamat_negeri' => $request->alamat_negeri,
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
            //'no_telR' => $request->no_telRW,
            'nokp_pelajar' => $request->nokp_pelajar,
            'hubungan' => $request->hubungan,
            'pendapatan' => $request->pendapatan,
    
        ]);

        /*$user = Akademik::create([
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
            'mod' => $request->mod,
            'cgpa' => $request->cgpa,
            'sumber_biaya' => $request->sumber_biaya,
            'nama_penaja' => $request->nama_penaja,
            'status' => '1',
            
        ]);*/

        DB::table('maklumatakademik')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'no_pendaftaranpelajar' => $request->no_pendaftaranpelajar,
            'tkh_mula' => $request->tkh_mula,
            'tkh_tamat' => $request->tkh_tamat,
            'sem_semasa' => $request->sem_semasa,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulanpersem' => $request->bil_bulanpersem,
            'mod' => $request->mod,
            'cgpa' => $request->cgpa,
            'sumber_biaya' => $request->sumber_biaya,
            'nama_penaja' => $request->nama_penaja,
            'status' => '1',

        ]);

        $user = TuntutanPermohonan::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'program' => 'BKOKU',
            'yuran' => $request->yuran,
            'elaun' => $request->elaun,
            'amaun' => $request->amaun,
            'perakuan' => $request->perakuan,
            
        ]);

        $user = Status::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'status' => '1',
            
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

    public function statuspermohonan(){
        $permohonan = Status::all()->where('nokp_pelajar', Auth::user()->id());

        return view('pages.statuspermohonan.statusmohon', compact('permohonan'));
        
    }
}


