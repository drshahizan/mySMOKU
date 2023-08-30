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
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use session;

class PenyelarasController extends Controller
{
    public function create()
    {   
        //$smoku = Smoku::all()->where('jenis','=', 'IPTA');
        $smoku = Smoku::join('permohonan','permohonan.nokp_pelajar','=','smoku.nokp')
        ->get(['smoku.*', 'permohonan.*'])
        ->where('status','=', '1')
        ->where('jenis','=', 'IPTA');
        //dd($smoku);
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
        $smoku = Smoku::join('permohonan','permohonan.nokp_pelajar','=','smoku.nokp')
        //->join('maklumatakademik','maklumatakademik.nokp_pelajar','=','smoku.nokp')
        ->get(['smoku.*', 'permohonan.*'])
        ->where('status','=', '2')
        ->where('jenis','=', 'IPTA');
        //return($smoku);
        return view('pages.penyelaras.permohonan.permohonanbaru', compact('smoku'));
    }

   
    public function keseluruhanPermohonan()
    {
        return view('pages.penyelaras.permohonan.keseluruhanmohon');
    }

    public function borangPermohonanBaru($nokp)
    {

        //$nokp = $request->session()->get('nokp_pelajar');
        //dd($nokp);
        $smoku = Smoku::join('bk_jantina','bk_jantina.kodjantina','=','smoku.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'smoku.bangsa')
        ->join('bk_hubungan','bk_hubungan.kodhubungan','=','smoku.hubungan')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','smoku.kecacatan')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_bangsa.*', 'bk_hubungan.*', 'bk_jenisoku.*'])
        ->where('nokp', $nokp);
        $infoipt = Infoipt::all()->where('jenis_ipt','IPTA')->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kodmod');
        $biaya = Sumberbiaya::all()->sortBy('kodbiaya');
        $hubungan = Hubungan::all()->sortBy('kodhubungan');

        $pelajar = Permohonan::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', $nokp);
        //dd($pelajar);
        $waris = Waris::join('bk_hubungan','bk_hubungan.kodhubungan','=','waris.hubungan')
        ->get(['waris.*', 'bk_hubungan.*'])
        ->where('nokp_pelajar', $nokp);
        //dd($waris);
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->join('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->join('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', $nokp);
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', $nokp);
        $akademikmqa = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', $nokp);
        $status = Status::all()->where('nokp_pelajar', $nokp);
        $dokumen = Dokumen::all()->where('nokp_pelajar', $nokp);
        $negeri = Negeri::orderby("kod","asc")->select('id','nama')->get();
        return view('pages.penyelaras.permohonan.mohonbaruform', compact('smoku','pelajar','hubungan','akademikmqa','infoipt','peringkat','kursus','mod','biaya','negeri'));
    }

    // Fetch records
   public function bandar($idnegeri){

    // Fetch kursus by idipt
        $loaddataBandar['data'] = Bandar::orderby("nama","asc")
         ->select('id','nama','negeri')
         ->where('negeri',$idnegeri)
         ->get();

         return response()->json($loaddataBandar);

    }

   // Fetch records
   public function peringkat($ipt=0){

        // Fetch kursus by idipt
        $peringkatData['data'] = DB::table('kursus')
        ->select('kursus.kodperingkat','bk_peringkatpengajian.peringkat')
        ->join('bk_peringkatpengajian', function ($join) {
            $join->on('kursus.kodperingkat', '=', 'bk_peringkatpengajian.kodperingkat'); 
        })
        ->where('idipt',$ipt)
        ->groupBy('kursus.kodperingkat','bk_peringkatpengajian.peringkat')

        ->get();
         

         return response()->json($peringkatData);

    }
    public function kursus($kodperingkat=0,$ipt=0){

        // Fetch kursus by idipt
        $kursusData['data'] = Kursus::orderby("nama_kursus","asc")
            ->select('idipt','kodperingkat','nama_kursus')
            ->where('kodperingkat',$kodperingkat)
            ->where('idipt',$ipt)
            
            //->where(["idipt"=> $ipt, "kodperingkat" => $kodperingkat])
            ->get();

            return response()->json($kursusData);

    }

    public function simpan(Request $request)
    {   

        $user = Permohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($user === null) {
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
        }else {
        DB::table('pelajar')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

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
        }

        $waris = Waris::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($waris === null) {
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
        }else {
            DB::table('waris')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

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
        }

        $akademik= Akademik::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($akademik === null) {
            $user = Akademik::create([
                'no_pendaftaranpelajar' => $request->no_pendaftaranpelajar,
                'sesi' => $request->sesi,
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
        }else {
        DB::table('maklumatakademik')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'no_pendaftaranpelajar' => $request->no_pendaftaranpelajar,
            'sesi' => $request->sesi,
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
        }
       

        $tuntutanpermohonan = TuntutanPermohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($tuntutanpermohonan === null) {
            $user = TuntutanPermohonan::create([
                'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
                'nokp_pelajar' => $request->nokp_pelajar,
                'program' => 'BKOKU',
                'yuran' => $request->yuran,
                'elaun' => $request->elaun,
                'amaun' => $request->amaun,
                'amaunelaun' => $request->amaunelaun,
                'perakuan' => $request->perakuan,
                'status' => '1',
        
            ]);
        }else {

        DB::table('permohonan')->where('nokp_pelajar' ,$request->nokp_pelajar)
            ->update([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'program' => 'BKOKU',
            'yuran' => $request->yuran,
            'elaun' => $request->elaun,
            'amaun' => $request->amaun,
            'amaunelaun' => $request->amaunelaun,
            'perakuan' => $request->perakuan,
            'status' => '1',
            
        ]);
        }
        $statustransaksi = Status::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($statustransaksi === null) {
            $user = Status::create([
                'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
                'nokp_pelajar' => $request->nokp_pelajar,
                'status' => '1',
        
            ]);
        }else {

        DB::table('statustransaksi')->where('nokp_pelajar' ,$request->nokp_pelajar)
            ->update([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'status' => '1',
            
        ]);
        }

        $user->save();


        $data=new dokumen();
        
          
            $akaunBank=$request->akaunBank;
            //$name1=$akaunBank->getClientOriginalName();  
            $name1='salinanbank';  
            $filenameakaunBank = '';
            if($akaunBank){
                $filenameakaunBank=$name1.'_'.$request->nokp_pelajar.'.'.$akaunBank->getClientOriginalExtension();
                $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
            
            }
            
            
            $suratTawaran=$request->suratTawaran;
            //$name2=$suratTawaran->getClientOriginalName();
            $name2='salinantawaran'; 
            $filenamesuratTawaran = '';
            if($suratTawaran){
            $filenamesuratTawaran=$name2.'_'.$request->nokp_pelajar.'.'.$suratTawaran->getClientOriginalExtension();
            $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);
            }

            $invoisResit=$request->invoisResit;
            //$name3=$invoisResit->getClientOriginalName();
            $name3='salinanresit';  
            $filenameinvoisResit = '';
            if($invoisResit){
            $filenameinvoisResit=$name1.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
            $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
            }
            
            $data->id_permohonan='KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar;
            $data->nokp_pelajar=$request->nokp_pelajar;
            $data->akaunBank=$filenameakaunBank;
            $data->suratTawaran=$filenamesuratTawaran;
            $data->invoisResit=$filenameinvoisResit;
            $data->nota_akaunBank=$request->nota_akaunBank;
            $data->nota_suratTawaran=$request->nota_suratTawaran;
            $data->nota_invoisResit=$request->nota_invoisResit;
            

            $data->save();




        return redirect()->route('dashboardpenyelaras');

    }

    public function hantar(Request $request)
    {   

        $tuntutanpermohonan = TuntutanPermohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($tuntutanpermohonan != null) {
            DB::table('permohonan')->where('nokp_pelajar' ,$request->nokp_pelajar)
            ->update([
            /*'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'program' => 'BKOKU',
            'yuran' => $request->yuran,
            'elaun' => $request->elaun,
            'amaun' => $request->amaun,
            'amaunelaun' => $request->amaunelaun,*/
            'perakuan' => $request->perakuan,
            'status' => '2',
            
        ]);
        }
        
        $user = Status::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'status' => '2',
    
        ]);
        $user->save();


        $data=new dokumen();
        
          
            $akaunBank=$request->akaunBank;
            //$name1=$akaunBank->getClientOriginalName();  
            $name1='salinanbank';  
            $filenameakaunBank=$name1.'_'.$request->nokp_pelajar.'.'.$akaunBank->getClientOriginalExtension();
            $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
            
            $suratTawaran=$request->suratTawaran;
            //$name2=$suratTawaran->getClientOriginalName();
            $name2='salinantawaran'; 
            $filenamesuratTawaran=$name2.'_'.$request->nokp_pelajar.'.'.$suratTawaran->getClientOriginalExtension();
            $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);

            $invoisResit=$request->invoisResit;
            //$name3=$invoisResit->getClientOriginalName();
            $name3='salinanresit';  
            $filenameinvoisResit=$name1.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
            $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
            
            $data->id_permohonan='KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar;
            $data->nokp_pelajar=$request->nokp_pelajar;
            $data->akaunBank=$filenameakaunBank;
            $data->suratTawaran=$filenamesuratTawaran;
            $data->invoisResit=$filenameinvoisResit;
            $data->nota_akaunBank=$request->nota_akaunBank;
            $data->nota_suratTawaran=$request->nota_suratTawaran;
            $data->nota_invoisResit=$request->nota_invoisResit;
            

            $data->save();


        return redirect()->route('dashboardpenyelaras');

        //return redirect()->route('viewpermohonan')->with('message', 'Permohonan anda telah dihantar.');

    }

}
