<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SekretariatController extends Controller
{
    public function dashboard()
    {
        return view('pages.sekretariat.dashboard');
    }
    
    public function statusPermohonan()
    {
        return view('pages.sekretariat.permohonan.status');
    }

    public function permohonanBaru()
    {
        return view('pages.sekretariat.permohonan.baru');
    }

    public function pembaharuanPermohonan()
    {
        return view('pages.sekretariat.permohonan.pembaharuan');
    }

    public function keputusanPermohonan()
    {
        return view('pages.sekretariat.permohonan.keputusan');
    }
}
