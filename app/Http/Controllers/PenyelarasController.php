<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smoku;
use App\Models\Permohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\User;
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

    public function borangPermohonanBaru()
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
        return view('pages.penyelaras.permohonan.mohonbaruform', compact('smoku','akademikmqa','infoipt','peringkat','kursus','mod','biaya'));
    }

}
