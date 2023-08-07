<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        //return view('pages.dashboards.index');
        /*if (Auth::check())
        {
            $id = Auth::user()->tahap();
            return $id;
        }*/


        if(Auth::user()->tahap=='1')
        {
            return view('pages.dashboards.index')->with('message', 'Selamat Datang ke Laman Utama Pelajar');
        }
        else if(Auth::user()->tahap=='2')
        {
            return view('pages.penyelaras.dashboard')->with('message', 'Selamat Datang ke Laman Utama Penyelaras');
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
