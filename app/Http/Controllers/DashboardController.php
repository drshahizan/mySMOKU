<?php

namespace App\Http\Controllers;
use Carbon\Traits\ToStringFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use App\Models\User;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Tuntutan;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\Smoku;
use Illuminate\Support\Facades\DB;
use App\Models\Mod;
use App\Models\StatusTuntutan;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        if(Auth::user()->tahap=='1')
        {
            $user = User::all()->where('no_kp',Auth::user()->no_kp);
            $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
            $permohonan = Permohonan::orderby("sejarah_permohonan.created_at","desc")
            ->join('sejarah_permohonan','sejarah_permohonan.permohonan_id','=','permohonan.id')
            ->join('bk_status','bk_status.kod_status','=','sejarah_permohonan.status')
            ->get(['sejarah_permohonan.*','permohonan.*','bk_status.status'])
            ->where('smoku_id',$smoku_id->id);
            //dd($permohonan);
            $akademik = Akademik::all()->where('smoku_id',$smoku_id->id)->first();

            $tuntutan = Tuntutan::orderby("sejarah_tuntutan.created_at","desc")
            ->join('sejarah_tuntutan','sejarah_tuntutan.tuntutan_id','=','tuntutan.id')
            ->join('bk_status','bk_status.kod_status','=','sejarah_tuntutan.status')
            ->get(['sejarah_tuntutan.*','tuntutan.*','bk_status.status'])
            ->where('smoku_id',$smoku_id->id);
            //dd($tuntutan);
            
            return view('pages.dashboards.index', compact('user','permohonan','akademik','tuntutan'))->with('message', 'Selamat Datang ke Laman Utama Pelajar');
        }
        else if(Auth::user()->tahap=='2')
        {
            return redirect()->route('penyelaras.dashboard');
        }
        else if(Auth::user()->tahap=='3')
        {
            return view('dashboard.sekretariat.dashboard')->with('message', 'Selamat Datang ke Laman Utama Sekretariat');
        }
        else if(Auth::user()->tahap=='4')
        {
            return redirect()->route('pegawai.dashboard');
        }
        else if(Auth::user()->tahap=='5')
        {
            return redirect()->route('pentadbir.dashboard');
        }
        else 
            return redirect()->route('penyelaras.ppk.dashboard');
    }


    public function store(Request $request)
    {  

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
    


    
