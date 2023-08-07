<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Auth\SemakRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Smoku;
use DB;

class DaftarUserController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {   
        //addJavascriptFile('assets/js/custom/authentication/daftar/general.js');
        return view('pages.auth.register');

        
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'nokp' => ['required', 'string'],
            
        ]);

        //$nokp_in = $request->nokp;
        $nokp_smoku=Smoku::where([
            ['nokp', '=', $request->nokp],
            ])->first();

            
            if ($nokp_smoku != null) {
                DB::table('smoku')->where('nokp' ,$request->nokp)->update([

                'verify'=>'1'
    
                ]);

                //return view('pages.auth.semaksyarat');
                return redirect()->route('semaksyarat');
            } else {

                //return view('pages.auth.login')->with('successMsg','Maklumat anda tiada dalam semakkan SMOKU');
                return redirect()->route('login')
                ->with('message', 'Maklumat anda tiada dalam semakkan SMOKU');
            }


    }

    
    
}
