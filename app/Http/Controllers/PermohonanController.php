<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\User;
use App\Models\Smoku;
use App\Models\Infoipt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\SumberBiaya;
use App\Models\Penaja;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\JenisOku;
use App\Models\Dokumen;
use App\Models\Peperiksaan;
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PermohonanController extends Controller
{
    public function permohonan()
    {

        /*$smoku = Smoku::join('bk_jantina','bk_jantina.kodjantina','=','smoku.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'smoku.bangsa')
        ->join('bk_hubungan','bk_hubungan.kodhubungan','=','smoku.hubungan')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','smoku.kecacatan')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_bangsa.*', 'bk_hubungan.*', 'bk_jenisoku.*'])
        ->where('nokp', Auth::user()->nokp);
        //$contoh=Auth::user()->nokp;
        //return($contoh);
        $infoipt = Infoipt::all()->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kodmod');
        $biaya = Sumberbiaya::all()->sortBy('kodbiaya');
        $hubungan = Hubungan::all()->sortBy('kodhubungan');

        $pelajar = Permohonan::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //return($pelajar);
        $waris = Waris::join('bk_hubungan','bk_hubungan.kodhubungan','=','waris.hubungan')
        ->leftjoin('bk_negeri','bk_negeri.id','=','waris.alamat_negeri')
        ->leftjoin('bk_bandar','bk_bandar.id','=','waris.alamat_bandar')
        ->get(['waris.*', 'bk_hubungan.*', 'bk_negeri.nama as namanegeri', 'bk_bandar.nama as namabandar'])
        //->get(['waris.*', 'bk_hubungan.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //return $waris;
        $akademik = Akademik::leftJoin('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->leftJoin('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->leftJoin('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->leftJoin('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //dd($akademik);
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->nokp);
        $tuntutan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->nokp)->first();
        //return $tuntutan;
        if ($tuntutan != null){
            $statuspermohonan =  $tuntutan->status;
            
        }else{
            $statuspermohonan =  '0';
        }
        //return $statuspermohonan;
        $akademikmqa = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $status = Status::all()->where('nokp_pelajar', Auth::user()->nokp);
        $dokumen = Dokumen::all()->where('nokp_pelajar', Auth::user()->nokp);
       // dd($dokumen);
        $negeri = Negeri::orderby("kod","asc")->select('id','nama')->get();
        
        if ($statuspermohonan >= '2')
        {
            return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan','dokumen'));

        } 
        else if ($statuspermohonan == '1')
        {
            return view('pages.permohonan.permohonan-baru-kemaskini', compact('smoku','hubungan','akademikmqa','infoipt','peringkat','kursus','mod','biaya','pelajar','waris','akademik','tuntutanpermohonan','dokumen','negeri'));
        }
        else
        {
            return view('pages.permohonan.permohonan-baru');
        }*/

        $smoku = Smoku::join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
        ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
        ->join('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
        ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*'])
        ->where('no_kp', Auth::user()->no_kp);
        //dd($smoku);
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $akademikmqa = Akademik::join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('bk_peringkat_pengajian','bk_peringkat_pengajian.kod_peringkat','=','smoku_akademik.peringkat_pengajian')
        ->get(['smoku_akademik.*', 'bk_info_institusi.*', 'bk_peringkat_pengajian.*'])
        ->where('smoku_id',$smoku_id->id);
        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('kod_biaya');
        $penaja = Penaja::all()->sortBy('kod_penaja');
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri')->get();
        return view('pages.permohonan.permohonan-baru', compact('smoku','akademikmqa','mod','biaya','penaja','hubungan','negeri'));
        
        
    }

     // Fetch records
   public function getBandar($idnegeri=0){

        // Fetch kursus by idipt
        $bandarData['data'] = Bandar::orderby("bandar","asc")
         ->select('id','bandar','negeri_id')
         ->where('negeri_id',$idnegeri)
         ->get();

         return response()->json($bandarData);

    }

    public function simpanmohon(Request $request)
    {   

        $user = ButiranPelajar::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($user === null) {
            $user = ButiranPelajar::create([
                'nama_pelajar' => $request->nama_pelajar,
                'nokp_pelajar' => $request->nokp_pelajar,
                'tkh_lahir' => $request->tkh_lahir,
                'umur' => $request->umur,
                'jantina' => $request->jantina,
                'noJKM' => $request->noJKM,
                'kecacatan' => $request->kecacatan,
                'bangsa' => $request->bangsa,
                'alamat1' => $request->alamat1,
                //'alamat_negeri' => $request->alamat_negeri,
                //'alamat_bandar' => $request->alamat_bandar,
                //'alamat_poskod' => $request->alamat_poskod,
                'alamat_surat1' => $request->alamat_surat1,
                'alamat_surat_negeri' => $request->alamat_surat_negeri,
                'alamat_surat_bandar' => $request->alamat_surat_bandar,
                'alamat_surat_poskod' => $request->alamat_surat_poskod,
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
                //'alamat_negeri' => $request->alamat_negeri,
                //'alamat_bandar' => $request->alamat_bandar,
                //'alamat_poskod' => $request->alamat_poskod,
                'alamat_surat1' => $request->alamat_surat1,
                'alamat_surat_negeri' => $request->alamat_surat_negeri,
                'alamat_surat_bandar' => $request->alamat_surat_bandar,
                'alamat_surat_poskod' => $request->alamat_surat_poskod,
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
       

        $tuntutanpermohonan = Permohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($tuntutanpermohonan === null) {
            $user = Permohonan::create([
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
        $statustransaksi = SejarahPermohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($statustransaksi === null) {
            $user = SejarahPermohonan::create([
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

        $dokumen = Dokumen::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($dokumen === null) {

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
            $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
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
        } else {

            $akaunBank=$request->akaunBank;
            $name1='salinanbank';  
            $filenameakaunBank=$name1.'_'.$request->nokp_pelajar.'.'.$akaunBank->getClientOriginalExtension();
            $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
            
            $suratTawaran=$request->suratTawaran;
            $name2='salinantawaran'; 
            $filenamesuratTawaran=$name2.'_'.$request->nokp_pelajar.'.'.$suratTawaran->getClientOriginalExtension();
            $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);

            $invoisResit=$request->invoisResit;
            $name3='salinanresit';  
            $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
            $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
                
            DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
            ->update([
            'akaunBank' => $filenameakaunBank,
            'suratTawaran' => $filenamesuratTawaran,
            'invoisResit' => $filenameinvoisResit,
            ]);

        

        }




        return redirect()->route('viewpermohonan');

    }

    public function hantarpermohonan(Request $request)
    {   

        $tuntutanpermohonan = Permohonan::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
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
        
        $user = SejarahPermohonan::create([
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
            $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
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




        return redirect()->route('dashboard')->with('message', 'Permohonan anda telah dihantar.');

    }

    public function viewpermohonan(){
        $pelajar = ButiranPelajar::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $waris = Waris::join('bk_hubungan','bk_hubungan.kodhubungan','=','waris.hubungan')
        ->join('bk_negeri','bk_negeri.id','=','waris.alamat_negeri')
        ->join('bk_bandar','bk_bandar.id','=','waris.alamat_bandar')
        ->get(['waris.*', 'bk_hubungan.*', 'bk_negeri.nama as namanegeri', 'bk_bandar.nama as namabandar'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->join('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->join('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $tuntutanpermohonan = Permohonan::all()->where('nokp_pelajar', Auth::user()->nokp);
        $dokumen = Dokumen::all()->where('nokp_pelajar', Auth::user()->nokp);
        return view('pages.permohonan.permohonan-baru-view', compact('pelajar','waris','akademik','tuntutanpermohonan','dokumen'));
        
    }


    public function download(Request $request,$file){   
        return response()->download(public_path('assets/dokumen/'.$file));
    }

    public function kemaskini(){

        DB::table('permohonan')->where('nokp_pelajar' ,Auth::user()->nokp)
        ->update([

            'status' => '1',

        ]);

        $pelajar = ButiranPelajar::join('bk_jantina','bk_jantina.kodjantina','=','pelajar.jantina')
        ->join('bk_bangsa', 'bk_bangsa.kodbangsa', '=', 'pelajar.bangsa')
        ->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan')
        ->get(['pelajar.*', 'bk_jantina.*','bk_bangsa.*','bk_bangsa.*','bk_jenisoku.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $waris = Waris::join('bk_hubungan','bk_hubungan.kodhubungan','=','waris.hubungan')
        ->get(['waris.*', 'bk_hubungan.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $akademik = Akademik::join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi')
        ->join('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->join('bk_mod','bk_mod.kodmod','=','maklumatakademik.mod')
        ->join('bk_sumberbiaya','bk_sumberbiaya.kodbiaya','=','maklumatakademik.sumber_biaya')
        ->get(['maklumatakademik.*', 'bk_infoipt.*', 'bk_peringkatpengajian.*', 'bk_mod.*', 'bk_sumberbiaya.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $tuntutanpermohonan = Permohonan::all()->where('nokp_pelajar', Auth::user()->nokp);
        $dokumen = Dokumen::all()->where('nokp_pelajar', Auth::user()->nokp);
        $infoipt = InfoIpt::all()->sortBy('namaipt');
        $peringkat = PeringkatPengajian::all()->sortBy('kodperingkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kodmod');
        $biaya = SumberBiaya::all()->sortBy('kodbiaya');
        $hubungan = Hubungan::all()->sortBy('kodhubungan');
        return view('pages.permohonan.permohonan-baru-kemaskini', compact('pelajar','waris','akademik','mod','biaya','tuntutanpermohonan','dokumen'));
        
    }

    public function update(Request $request)
    {   
        DB::table('pelajar')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'alamat_surat1' => $request->alamat_surat1,
            'alamat_surat_negeri' => $request->alamat_surat_negeri,
            'alamat_surat_bandar' => $request->alamat_surat_bandar,
            'alamat_surat_poskod' => $request->alamat_surat_poskod,
            'no_tel' => $request->no_tel,
            'no_telR' => $request->no_telR,
            'no_akaunbank' => $request->no_akaunbank,

        ]);

        DB::table('waris')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'nama_waris' => $request->nama_waris,
            'nokp_waris' => $request->nokp_waris,
            'alamat1' => $request->alamatW1,
            'alamat_poskod' => $request->alamatW_poskod,
            'alamat_bandar' => $request->alamatW_bandar,
            'alamat_negeri' => $request->alamatW_negeri,
            'no_tel' => $request->no_telW,
            'no_telR' => $request->no_telRW,
            'hubungan' => $request->hubungan,
            'pendapatan' => $request->pendapatan,

        ]);

        DB::table('maklumatakademik')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'no_pendaftaranpelajar' => $request->no_pendaftaranpelajar,
            'sesi' => $request->sesi,
            'tkh_mula' => $request->tkh_mula,
            'tkh_tamat' => $request->tkh_tamat,
            //'sem_semasa' => $request->sem_semasa,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            //'bil_bulanpersem' => $request->bil_bulanpersem,
            //'mod' => $request->mod,
            'cgpa' => $request->cgpa,
            //'sumber_biaya' => $request->sumber_biaya,
            'nama_penaja' => $request->nama_penaja,
            'status' => '1',

        ]);

        DB::table('permohonan')->where('nokp_pelajar' ,$request->nokp_pelajar)
        ->update([

            'yuran' => $request->yuran,
            'elaun' => $request->elaun,
            'amaun' => $request->amaun,
            'amaunelaun' => $request->amaunelaun,
            'perakuan' => $request->perakuan,
            'status' => '2',

        ]);

        $user = SejarahPermohonan::create([
            'id_permohonan' => 'KPTBKOKU'.'/'.$request->peringkat_pengajian.'/'.$request->nokp_pelajar,
            'nokp_pelajar' => $request->nokp_pelajar,
            'status' => '2',
    
        ]);
        $user->save();

        $dokumen = Dokumen::where('nokp_pelajar', '=', $request->nokp_pelajar)->first();
        if ($dokumen === null) {

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
            $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
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
        } else {

            if($request->hasFile('akaunBank')){
                $akaunBank=$request->akaunBank;
                $name1='salinanbank';  
                $filenameakaunBank=$name1.'_'.$request->nokp_pelajar.'.'.$akaunBank->getClientOriginalExtension();
                $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'akaunBank' => $filenameakaunBank,
                ]);
            }
            
            if($request->hasFile('suratTawaran')){
                $suratTawaran=$request->suratTawaran;
                $name2='salinantawaran'; 
                $filenamesuratTawaran=$name2.'_'.$request->nokp_pelajar.'.'.$suratTawaran->getClientOriginalExtension();
                $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'suratTawaran' => $filenamesuratTawaran,
                ]);


            }

            if($request->hasFile('invoisResit')){
                $invoisResit=$request->invoisResit;
                $name3='salinanresit';  
                $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
                $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'invoisResit' => $filenameinvoisResit,
                ]);
        
            }

        

        }

            
            /*if($request->hasFile('akaunBank')){
                $akaunBank=$request->akaunBank;
                $name1='salinanbank';  
                $filenameakaunBank=$name1.'_'.$request->nokp_pelajar.'.'.$akaunBank->getClientOriginalExtension();
                $request->akaunBank->move('assets/dokumen',$filenameakaunBank);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'akaunBank' => $filenameakaunBank,
                ]);
            }
            
            if($request->hasFile('suratTawaran')){
                $suratTawaran=$request->suratTawaran;
                $name2='salinantawaran'; 
                $filenamesuratTawaran=$name2.'_'.$request->nokp_pelajar.'.'.$suratTawaran->getClientOriginalExtension();
                $request->suratTawaran->move('assets/dokumen',$filenamesuratTawaran);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'suratTawaran' => $filenamesuratTawaran,
                ]);


            }

            if($request->hasFile('invoisResit')){
                $invoisResit=$request->invoisResit;
                $name3='salinanresit';  
                $filenameinvoisResit=$name3.'_'.$request->nokp_pelajar.'.'.$invoisResit->getClientOriginalExtension();
                $request->invoisResit->move('assets/dokumen',$filenameinvoisResit);
                DB::table('dokumen')->where('nokp_pelajar' ,$request->nokp_pelajar)
                ->update([
                'invoisResit' => $filenameinvoisResit,
                ]);
        
            }*/

        return redirect()->route('dashboard')->with('message', 'Permohonan anda telah dikemaskini dan dihantar.');    
        //return redirect()->route('viewpermohonan')->with('message', 'Permohonan anda telah dikemaskini dan dihantar.');
        
    }
 

    public function statuspermohonan(){
        $permohonan = SejarahPermohonan::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        return view('pages.permohonan.statusmohon', compact('permohonan'));
        
    }

    public function batalpermohonan(){
        $permohonan = SejarahPermohonan::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokpm);
        return view('pages.permohonan.statusmohon', compact('permohonan'));
        
    }

    public function delete($nokp){

        //$pelajar = Permohonan::find($nokp);
        $pelajar = DB::table('pelajar')->where('nokp_pelajar', $nokp)->first();
        $nokp = $pelajar->nokp_pelajar;
        //$pelajar->delete(); //delete pelajar

        $permohonan = DB::table('permohonan')->where('nokp_pelajar', $nokp)->first();
        $id_permohonan = $permohonan->id_permohonan;
        //$permohonan->delete();
        DB::table('pelajar')->where('nokp_pelajar',$nokp)->delete();
        DB::table('permohonan')->where('id_permohonan',$id_permohonan)->delete(); //delete permohonan
        DB::table('waris')->where('nokp_pelajar',$nokp)->delete();
        DB::table('maklumatakademik')->where('nokp_pelajar' ,$nokp)
        ->update([

            'no_pendaftaranpelajar' => NULL,
            'sesi' => NULL,
            'tkh_mula' => NULL,
            'tkh_tamat' => NULL,
            'sem_semasa' => NULL,
            'tempoh_pengajian' => NULL,
            'bil_bulanpersem' => NULL,
            'mod' => NULL,
            'cgpa' => NULL,
            'sumber_biaya' => NULL,
            'nama_penaja' => NULL,
            'status' => NULL,

        ]);

        DB::table('dokumen')->where('id_permohonan',$id_permohonan)->delete();
        DB::table('statustransaksi')->where('id_permohonan',$id_permohonan)->delete();
        
        return redirect()->route('sejarahpermohonan');
        
    }

    public function baharuimohon()
    {   
        $peperiksaan = Peperiksaan::all();
        return view('pages.permohonan.baharuimohon', compact('peperiksaan'));
    }

    public function save(Request $request)
    {   
        
        $data=new peperiksaan();
        
          
            $kepPeperiksaan=$request->kepPeperiksaan; 
            $sem=$request->semester; 
            $sesi=$request->sesi; 
            $nokp = Auth::user()->nokp;
            //dd($nokp);
            $name1='kepPeperiksaan';  
            //$filenamekepPeperiksaan=$name1.'-'.$sesi.'_'.$sem.'.'.$kepPeperiksaan->getClientOriginalExtension();
            $filenamekepPeperiksaan=$name1.'-'.$nokp.'_'.$sem.'.'.$kepPeperiksaan->getClientOriginalExtension();
            //dd($request->filenamekepPeperiksaan);
            $request->kepPeperiksaan->move('assets/peperiksaan',$filenamekepPeperiksaan);
            
            $data->nokp_pelajar=$nokp;
            $data->sesi=$request->sesi;
            $data->semester=$request->semester;
            $data->cgpa=$request->cgpa;
            $data->kepPeperiksaan=$filenamekepPeperiksaan;


            

            $data->save();




        return redirect()->route('baharuimohon')->with('message', 'saveeeeeeeee.');

    }

}


