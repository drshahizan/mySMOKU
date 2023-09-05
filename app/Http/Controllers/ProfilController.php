<?php

namespace App\Http\Controllers;
use Carbon\Traits\ToStringFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use App\Models\User;
use App\Models\Permohonan;
use App\Models\Status;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;
use App\Models\Smoku;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    
    public function profildiri()
    {
        $user = User::all()->where('nokp',Auth::user()->nokp);
        return view('pages.profil.profildiri', compact('user'));
        
    }
    public function store(Request $request)
    {  
        // dd($request->hasFile("profile_photo_path"));
        

        if($request->hasFile('profile_photo_path')){
            
            $filename = strval(Auth::user()->nokp) . "_" . $request->profile_photo_path->getClientOriginalName();
            //dd($filename);
            //$request->profile_photo_path->storeAs('profile_photo_path',$filename,'public');
            $request->profile_photo_path->move('assets/profile_photo_path',$filename);
            //Auth()->user()->update(['profile_photo_path'=>$filename]);
            DB::table('users')->where('nokp',Auth::user()->nokp)
            ->update([
            'profile_photo_path' => $filename,
            
            
        ]);
            
        }
        return back()->with('success', 'Avatar updated successfully.');
    }
}
