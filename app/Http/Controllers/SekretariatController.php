<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SekretariatController extends Controller
{
    public function statusPermohonan()
    {
        return view('pages.sekretariat.permohonan.status');
    }
    public function keputusanPermohonan()
    {
        return view('pages.sekretariat.permohonan.keputusan');
    }
}
