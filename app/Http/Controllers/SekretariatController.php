<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SekretariatController extends Controller
{
    public function sekretariat()
    {
        return view('pages.sekretariat.permohonan.status');
    }
}
