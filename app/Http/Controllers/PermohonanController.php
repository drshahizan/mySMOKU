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
use App\Models\JenisOku;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;
use DB;

class PermohonanController extends Controller
{
    public function permohonan()
    {

        $smoku = Smoku::join('bk_jantina','bk_jantina.kodjantina','=','smoku.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'smoku.bangsa')
        ->join('bk_hubungan','bk_hubungan.kodhubungan','=','smoku.hubungan')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','smoku.kecacatan')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_bangsa.*', 'bk_hubungan.*', 'bk_jenisoku.*'])
        ->where('nokp', Auth::user()->id());
        $infoipt = Infoipt::all()->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kodmod');
        $biaya = Sumberbiaya::all()->sortBy('kodbiaya');

        $pelajar = Permohonan::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $waris = Waris::join('bk_hubungan','bk_hubungan.kodhubungan','=','waris.hubungan')
        ->get(['waris.*', 'bk_hubungan.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->join('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->join('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $akademikmqa = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $status = Status::all()->where('nokp_pelajar', Auth::user()->id());
        $dokumen = Dokumen::all()->where('nokp_pelajar', Auth::user()->id());
        if (!$status->isEmpty())
        {
            return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan','dokumen'));

        }
        else
        {
            //return view('pages.permohonan.permohonan-baru');
            return view('pages.permohonan.permohonan-baru', compact('smoku','akademikmqa','infoipt','peringkat','kursus','mod','biaya'));
        }
        
        
    }


    public function store(Request $request)
    {   
        /*$request->session()->regenerate();
        $request->validate([
			'nama_pelajar' => 'required',
			'nokp_pelajar' => 'required|unique:pelajar',
			//'noJKM' => 'required',
            //'no_akaunbank' => 'required',
            //'emel' => 'required'
            
        ]);*/

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
            'status' => '2',
            
        ]);

        $user = Status::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'status' => '2',
            
        ]);
        
        $user->save();


        $data=new dokumen();
        
          
            $akaunBank=$request->akaunBank;
            $name1=$akaunBank->getClientOriginalName();  
            $filenameakaunBank=$name1.'.'.$akaunBank->getClientOriginalExtension();
            $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
            
            $suratTawaran=$request->suratTawaran;
            $name2=$suratTawaran->getClientOriginalName(); 
            $filenamesuratTawaran=$name2.'.'.$suratTawaran->getClientOriginalExtension();
            $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);

            $invoisResit=$request->invoisResit;
            $name3=$invoisResit->getClientOriginalName(); 
            $filenameinvoisResit=$name3.'.'.$invoisResit->getClientOriginalExtension();
            $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
            
            $data->id_permohonan='KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar;
            $data->nokp_pelajar=$request->nokp_pelajar;
            $data->akaunBank=$filenameakaunBank;
            $data->suratTawaran=$filenamesuratTawaran;
            $data->invoisResit=$filenameinvoisResit;
            

            $data->save();



        //return view('pages.dashboards.index'); // jadi yang ni kena return ke page view
        return redirect()->route('viewpermohonan');
        //return redirect()->back();

        // $request->session()->invalidate();
    }

    public function viewpermohonan(){
        $pelajar = Permohonan::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $waris = Waris::all()->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->join('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->join('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $dokumen = Dokumen::all()->where('nokp_pelajar', Auth::user()->id());
        return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan','dokumen'));
        
    }


    public function download(Request $request,$file)
    {   
        return response()->download(public_path('assets/dokumen/'.$file));
    }
 

    public function statuspermohonan(){
        $permohonan = Status::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        return view('pages.permohonan.statusmohon', compact('permohonan'));
        
    }

    public function batalpermohonan(){
        $permohonan = Status::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        return view('pages.permohonan.statusmohon', compact('permohonan'));
        
    }
}


