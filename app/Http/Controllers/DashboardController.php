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

        $pelajar = Permohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $status = Status::leftJoin('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['statustransaksi.*', 'statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $akademik = Akademik::all()
        //leftJoin('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        //->get(['maklumatakademik.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $sem = Akademik::
        leftJoin('bk_peringkatpengajian','bk_peringkatpengajian.kodperingkat','=','maklumatakademik.peringkat_pengajian')
        ->get(['maklumatakademik.*', 'bk_peringkatpengajian.*'])
        ->where('nokp_pelajar', Auth::user()->id());
        $tuntutanpermohonan = TuntutanPermohonan::all()->where('nokp_pelajar', Auth::user()->id());
        $smoku = Smoku::all()->where('jenis','=', 'IPTA');



        if(Auth::user()->tahap=='1')
        {
            return view('pages.dashboards.index', compact('pelajar','status','akademik','sem','tuntutanpermohonan'))->with('message', 'Selamat Datang ke Laman Utama Pelajar');
        }
        else if(Auth::user()->tahap=='2')
        {
            return view('pages.penyelaras.dashboard', compact('smoku'))->with('message', 'Selamat Datang ke Laman Utama Penyelaras');
        }
        else if(Auth::user()->tahap=='3')
        {
            return view('pages.sekretariat.dashboard')->with('message', 'Selamat Datang ke Laman Utama Sekretariat');
        }
        else{
            return view('pages.pegawai.dashboard')->with('status', 'Selamat Datang ke Laman Utama Pegawai Atasan');
        }
    }
}
