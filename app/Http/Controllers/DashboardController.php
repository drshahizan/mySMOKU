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
use App\Models\InfoIpt;
use App\Models\MaklumatBank;
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
            //TUTUP. SEBAB TAKNAK SET PASSWORD UTK USER LAMA
            // if (Auth::user()->data_migrate == '1')
            //     return redirect()->route('kemaskini.emel.katalaluan');
            // else
                return redirect()->route('pelajar.dashboard');
        }
        else if(Auth::user()->tahap=='2')
        {
            $bank = MaklumatBank::where('institusi_id', Auth::user()->id_institusi)->first();
            $idInstitusi = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

            if ($bank || ($idInstitusi->jenis_institusi === 'P' || $idInstitusi->jenis_institusi === 'KK')) {
                return redirect()->route('penyelaras.dashboard');
            } else {
                return redirect()->route('maklumat.bank')->with('notifikasi', 'Sila kemaskini maklumat bank institusi terlebih dahulu.');
            }

        }
        else if(Auth::user()->tahap=='3')
        {
            return redirect()->route('sekretariat.dashboard');
            // return view('dashboard.sekretariat.dashboard')->with('message', 'Selamat Datang ke Laman Utama Sekretariat');
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
        if($request->hasFile('profile_photo_path'))
        {
            $filename = strval(Auth::user()->nokp) . "_" . $request->profile_photo_path->getClientOriginalName();
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
    


    
