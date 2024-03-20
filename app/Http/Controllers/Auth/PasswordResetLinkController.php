<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPassword;
use App\Models\TarikhIklan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/reset-password/reset-password.js');
        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";
        

        return view('pages.auth.forgot-password', compact('catatan'));
    }

    public function getEmail($no_kp)
    {
        // Retrieve the user by 'no_kp'
        $user = User::where('no_kp', $no_kp)->first();

        // Check if user exists and get the email
        if ($user) {
            $email = $user->email;
            $success = true;
        } else {
            $email = null;
            $success = false;
        }
        
        // Return JSON response with success flag and email data
        return response()->json(['success' => $success, 'email' => $email]);
    }


    public function store(Request $request)
    {
        $user = User::where('no_kp', $request->no_kp)->first();
        if ($user) {
            $emel = $user->email;
        
            if ($emel) {
                $token = Str::random(64); // Generate a unique token
                DB::table('password_resets')->insert([
                    'email' => $emel,
                    'token' => $token,
                    'created_at' => now(),
                ]);
        
                $resetLink = route('password.reset', ['token' => $token]);
        
                // Send the email with the reset link and token
                Mail::to($emel)->send(new ResetPassword($token));
                return response()->json(['success' => true, 'message' => 'Password reset email sent successfully.'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'User email is null.'], 400);
            }
        }
        else{

            return response()->json(['success' => false, 'message' => 'Pengguna tidak wujud.'], 200);

        }    
                            
    }
}
