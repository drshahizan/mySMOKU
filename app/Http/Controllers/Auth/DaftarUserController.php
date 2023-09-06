<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Auth\SemakRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Smoku;
use Illuminate\Support\Facades\DB;
use session;

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
        $nokp_smoku=Smoku::where([['nokp', '=', $request->nokp]])
        ->orWhere('noJKM','=', $request->nokp)
        ->first();

         //dd($nokp_smoku);   

            
            if ($nokp_smoku != null) {
                DB::table('smoku')->where('nokp' ,$request->nokp)
                ->orWhere('noJKM','=', $request->nokp)
                ->update([

                'verify'=>'1'
    
                ]);

                //return view('pages.auth.semaksyarat');
                $nokp_in = $request->nokp;
                //dd($nokp_in);
                $nokpornojkm = Smoku::where('nokp', $nokp_in)->orWhere('noJKM','=', $nokp_in)->first();
                //$nokp = $request->session()->put('nokp',$nokp_in);
                $nokp1 =  $nokpornojkm->nokp;
                $nokp = $request->session()->put('nokp',$nokp1);
                //dd($nokp);
                return redirect()->route('semaksyarat')->with($nokp)
                ->with('message', $nokp_in. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } else {

                $nokp_in = $request->nokp;
                //return view('pages.auth.login')->with('successMsg','Maklumat anda tiada dalam semakkan SMOKU');
                return redirect()->route('login')
                ->with('message', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }


    }

    
    
}
