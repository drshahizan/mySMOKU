<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        //$user = User::find($id);
        $user = User::where('no_kp', '=', $id)->first();
        // $test=sha1($user->email);

        if (!$user || sha1($user->email) !== $hash) {
            // Invalid verification link
            return redirect('/login')->with('error', 'Link pengesahan tidak sah.');
        }

        // Mark the user's email as verified
        $user->email_verified_at = now();
        $user->save();

        // Optionally, show a success message
        return redirect('/login')->with('success', 'Emel berjaya disahkan. Anda boleh log masuk sekarang.');
    }
}
