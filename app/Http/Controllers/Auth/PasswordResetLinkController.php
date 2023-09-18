<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPassword; 
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
        return view('pages.auth.forgot-password');
    }


    public function store(Request $request)
    {
        $token = Str::random(64); // Generate a unique token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);
        
        $resetLink = route('password.reset', ['token' => $token]);

        // Send the email with the reset link and token
        Mail::to($request->email)->send(new ResetPassword($token));
                            
    }
}
