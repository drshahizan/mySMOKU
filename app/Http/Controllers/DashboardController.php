<?php

namespace App\Http\Controllers;
use Carbon\Traits\ToStringFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use App\Models\User;
use App\Models\Permohonan;
use App\Models\Status;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\Smoku;
use Illuminate\Support\Facades\DB;
use App\Models\Mod;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        $user = Auth()->user();

        $pelajar = Permohonan::where('nokp_pelajar', $user->nokp)->first();
        $status = Status::leftJoin('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['statustransaksi.*', 'statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $akademik = Akademik::where('nokp_pelajar', $user->nokp)->first();
        $sem = Akademik::leftJoin('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->nokp)->first();
        $modpengajian = Mod::where('kodmod', $akademik->mod)->first();
        $tuntutanpermohonan = TuntutanPermohonan::Join('statusinfo','statusinfo.kodstatus','=','permohonan.status')
        ->get(['permohonan.*', 'statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //$smoku = Smoku::all()->where('jenis','=', 'IPTA');
        $smoku = Smoku::orderBy('smoku.id','desc')
        ->leftJoin('permohonan','permohonan.nokp_pelajar','=','smoku.nokp')
        ->get(['smoku.*', 'permohonan.*'])
        ->where('status','!=', '2')
        ->where('jenis','=', 'IPTA');
        $permohonan = Status::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //return view('pages.permohonan.statusmohon', compact('permohonan'));
        $user = User::all()->where('nokp',Auth::user()->nokp);


        if(Auth::user()->tahap=='1')
        {
            return view('pages.dashboards.index', compact('pelajar','status','akademik','sem','tuntutanpermohonan', 'permohonan','user', 'modpengajian'))->with('message', 'Selamat Datang ke Laman Utama Pelajar');
        }
        else if(Auth::user()->tahap=='2')
        {
            return view('pages.penyelaras.dashboard', compact('smoku'))->with('message', 'Selamat Datang ke Laman Utama Penyelaras');
        }
        else if(Auth::user()->tahap=='3')
        {
            return view('pages.sekretariat.dashboard')->with('message', 'Selamat Datang ke Laman Utama Sekretariat');
        }
        else if(Auth::user()->tahap=='4'){
            return view('pages.pegawai.dashboard')->with('message', 'Selamat Datang ke Laman Utama Pegawai Atasan');
        }
        else{
            return view('pages.pentadbir.dashboard')->with('message', 'Selamat Datang ke Laman Utama Pentadbir Sistem');
        }
    }

    public function store(Request $request)
    {  
        // dd($request->hasFile("profile_photo_path"));

        if($request->hasFile('profile_photo_path')){
            
            $filename = strval(Auth::user()->nokp) . "_" . $request->profile_photo_path->getClientOriginalName();
            //dd($filename);
            //$request->profile_photo_path->storeAs('profile_photo_path',$filename,'public');
            $request->profile_photo_path->move('assets/profile_photo_path',$filename);
            //Auth()->user()->update(['profile_photo_path'=>$filename]);
            DB::table('users')->where('nokp',Auth::user()->nokp)
            ->update([
            'profile_photo_path' => $filename,
            
            
        ]);
            
        }
        return back()->with('success', 'Avatar updated successfully.');
    }
}
