<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SemakUserController extends Controller
{
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/semak/general.js');

        return view('pages.auth.semaksyarat');
    }
    public function store(Request $request)
    {
        //$request->authenticate();
        $request->session()->regenerate();
        //return redirect()->intended(RouteServiceProvider::HOME);
        /*$request->validate([
            'terimaHLP' => ['required', 'string'],
            'cuti' => ['required', 'string'],
            'id_institusi' => ['required', 'string'],
            'peringkat_pengajian' => ['required', 'string'],
            'nama_kursus' => ['required', 'string'],
            
        ]);*/

        

        
    }
    
}
