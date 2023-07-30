<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        //addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        return view('pages.permohonan.permohonan-baru');
    }
}
