<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use App\Models\User;

class ProfilController extends Controller
{
    
    public function index()
    {
        $user = User::all()->where('no_kp',Auth::user()->no_kp);
        return view('kemaskini.profil_diri', compact('user'));
        
    }
    public function simpanProfil(Request $request)
    {  

        if($request->hasFile('profile_photo_path')){
            
            $filename = strval(Auth::user()->no_kp) . "_" . $request->profile_photo_path->getClientOriginalName();

            $request->profile_photo_path->move('assets/profile_photo_path',$filename);

            User::where('no_kp',Auth::user()->no_kp)
            ->update([
            'profile_photo_path' => $filename,
            
            
        ]);
            
        }
        return back()->with('success', 'Avatar updated successfully.');
    }
}
