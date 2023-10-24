<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaklumatKursusController extends Controller
{
    public function index(Request $request)
    {
        
        return view('mqa.maklumat_kursus');
            
    }
}
