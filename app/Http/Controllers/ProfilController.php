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
        return view('kemaskini.profil_diri', compact('user'));
    }

    public function simpanProfil(Request $request)
    {  
        // if($request->hasFile('profile_photo_path')){
            
        //     $filename = strval(Auth::user()->no_kp) . "_" . $request->profile_photo_path->getClientOriginalName();

        //     $request->profile_photo_path->move('assets/profile_photo_path',$filename);

        //     User::where('no_kp',Auth::user()->no_kp)
        //     ->update([
        //         'profile_photo_path' => $filename,
        //     ]);

        // }


        // Validate the file tak test lagi
        $request->validate([
            'profile_photo_path' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);

        if ($request->hasFile('profile_photo_path')) {
            // Get the original file name
            $originalFilename = $request->file('profile_photo_path')->getClientOriginalName();
            
            // Sanitize the filename by removing special characters
            $sanitizedFilename = preg_replace('/[^a-zA-Z0-9._-]/', '', $originalFilename);
            
            // Generate a unique filename
            $filename = Auth::user()->no_kp . "_" . time() . "_" . $sanitizedFilename;

            // Move the file to the designated directory
            $request->file('profile_photo_path')->move(public_path('assets/profile_photo_path'), $filename);

            // Update the user profile photo path in the database
            User::where('no_kp', Auth::user()->no_kp)->update([
                'profile_photo_path' => $filename,
            ]);

            // return response()->json(['message' => 'File uploaded successfully.']);
        }

        
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
        if($smoku_id != null) {
        ButiranPelajar::where('smoku_id' ,$smoku_id->id)
            ->update([
                'emel' => $request->email

            ]);
        }    
        return back()->with('success', 'Maklumat profil berjaya dikemaskini.');
    }

    public function simpanKatalaluan(Request $request)
    {  
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

        return redirect('/login')->with('berjaya', 'Berjaya tukar kata laluan, sila log masuk menggunakan kata laluan baru.');
    }

    public function kemaskiniEmelKatalaluan()
    {
        $user = User::all()->where('no_kp',Auth::user()->no_kp);
        return view('kemaskini.emel_password', compact('user'));
    }

    public function simpanEmelKatalaluan(Request $request)
    {
        $user = User::where('no_kp', Auth::user()->no_kp)->first();

        // Update email
        $user->email = $request->input('email');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        //Update data migrate
        $user->data_migrate = 2;

        $user->save();

        return redirect('/login')->with('success', 'Maklumat emel dan kata laluan telah dikemaskini.');
    }

}
