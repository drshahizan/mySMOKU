<?php

namespace App\Http\Controllers;

use App\Models\ButiranPelajar;
use App\Models\Smoku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;  
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    
    public function index()
    {
        $user = User::all()->where('no_kp',Auth::user()->no_kp);
        //dd($user);
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
        

            User::where('no_kp',Auth::user()->no_kp)
                ->update([
                    'nama' => $request->nama,
                    'email' => $request->email
                ]);
            
            Smoku::where('no_kp' ,Auth::user()->no_kp)
                ->update([
                    'nama' => $request->nama,
                    'email' => $request->email
                ]);

            $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
            ButiranPelajar::where('smoku_id' ,$smoku_id->id)
                ->update([
                    'emel' => $request->email

                ]);
            
        }
        return back()->with('success', 'Avatar updated successfully.');
    }

    public function simpanKatalaluan(Request $request)
    {  
        //dd('sini');
        $customMessages = [
            'password.required' => 'Medan kata laluan diperlukan.',
            'password_old.required' => 'Medan kata laluan lama diperlukan.',
            'password.min' => 'Kata laluan mesti mengandungi sekurang-kurangnya 12 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
        ];
        
        $request->validate(
            [
                'password_old' => ['required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Kata laluan semasa tidak sah.');
                    }
                }],
                'password' => ['required', 'min:12', 'confirmed', Rules\Password::defaults()],
            ],
            $customMessages // Pass the custom error messages array as the second argument to the validate method
        );

        User::where('no_kp',Auth::user()->no_kp)
            ->update([
                'password' => Hash::make($request->password)
            ]);
       
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
