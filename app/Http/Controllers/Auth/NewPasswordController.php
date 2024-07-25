<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TarikhIklan;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class NewPasswordController extends Controller
{
    
    public function create(Request $request, $token)
    {
        // Step 1: Retrieve the token from the URL query parameters
        $token = $token;
        
        // Step 2: Query the password_resets table to find the token
        $reset = DB::table('password_resets')
            ->where('token', $token)
            ->first();
        $email = $reset ->email;
        //dd($email);    

        // Step 3: Check if a matching record was found and validate the token
        if (!$reset || empty($reset->email)) {
            // Handle invalid token or token not found (display an error message)
            return redirect()->route('password.reset')->with('error', 'Invalid token or token not found.');
        }

        // Check if the token has expired (e.g., within a certain time limit)
        $expirationTime = config('auth.passwords.users.expire');
        if (now()->subMinutes($expirationTime) > $reset->created_at) {
            // Handle token expiration (display an error message)
            return redirect()->route('password.reset')->with('error', 'Token has expired. Please request a new one.');
        }

        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";

        // Step 4: Token is valid, show the password reset form
        return view('pages.auth.reset-password', compact('token', 'email', 'catatan'));
    }


    public function updatePassword(Request $request)
    {
        // Step 5: Handle the password update logic (when the user submits the new password)
        // Ensure that the provided token is valid before allowing password update
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Verify the token again and ensure it matches the user's email
        $reset = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->where('email', $request->input('email'))
            ->first();
        $user = User::where('email', '=', $request->input('email'))->first();    

        if (!$reset || empty($reset->email)) {
            // Handle invalid token or token not found (display an error message)
            return redirect()->route('password.reset')->with('error', 'Token tidak sah atau token tidak dijumpai.');
        }

        // Check if the token has expired (e.g., within a certain time limit)
        $expirationTime = config('auth.passwords.users.expire');
        if (now()->subMinutes($expirationTime) > $reset->created_at) {
            // Handle token expiration (display an error message)
            return redirect()->route('password.reset')->with('error', 'Token telah tamat tempoh. Sila minta yang baru.');
        }

        // Token is valid; update the user's password and delete the token
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect to a success page or login page after successful password reset
        return redirect()->route('login')->with('success', 'Set semula kata laluan berjaya. Anda kini boleh log masuk dengan kata laluan baru anda.');
    }
}
