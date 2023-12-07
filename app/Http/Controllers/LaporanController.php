<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function permohonan()
    {
        
        return view('pelaporan.permohonan');
       
    }
    public function tuntutan()
    {
        
        return view('pelaporan.tuntutan');
       
    }
}
