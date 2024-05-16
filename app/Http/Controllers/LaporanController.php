<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function keseluruhan()
    {
        
        return view('pelaporan.keseluruhan');
       
    }
    public function permohonan()
    {
        
        return view('pelaporan.permohonan');
       
    }
    public function statistik()
    {
        
        return view('pelaporan.statistik');
       
    }
    public function tuntutan()
    {
        
        return view('pelaporan.tuntutan');
       
    }
}
