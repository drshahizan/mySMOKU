<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permohonan;
use App\Models\Status;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\Smoku;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        $pelajar = Permohonan::all()->where('nokp_pelajar', Auth::user()->nokp);
        $status = Status::leftJoin('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['statustransaksi.*', 'statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $akademik = Akademik::all()
      
        ->where('nokp_pelajar', Auth::user()->nokp);
        $sem = Akademik::
        leftJoin('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        $tuntutanpermohonan = TuntutanPermohonan::Join('statusinfo','statusinfo.kodstatus','=','permohonan.status')
        ->get(['permohonan.*', 'statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //$smoku = Smoku::all()->where('jenis','=', 'IPTA');
        $smoku = Smoku::leftJoin('permohonan','permohonan.nokp_pelajar','=','smoku.nokp')
        ->get(['smoku.*', 'permohonan.*'])
        ->where('status','!=', '2')
        ->where('jenis','=', 'IPTA');
        $permohonan = Status::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokp);
        //return view('pages.permohonan.statusmohon', compact('permohonan'));


        if(Auth::user()->tahap=='1')
        {
            return view('pages.dashboards.index', compact('pelajar','status','akademik','sem','tuntutanpermohonan', 'permohonan'))->with('message', 'Selamat Datang ke Laman Utama Pelajar');
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
}
