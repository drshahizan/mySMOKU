<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Models\Smoku;
use session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        
        addJavascriptFile('assets/js/custom/authentication/sign-up/general.js');

        $nokp = $request->session()->get('no_kp');
        $smoku = Smoku::all()->where('no_kp', $nokp);
        //dd($smoku);

        return view('pages.auth.daftarlayak', compact('smoku'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kp' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        $user = User::create([
            'nama' => $request->nama,
            'no_kp' => $request->no_kp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
			'tahap' => '1',
            'status' => '1',
        ]);

        //UPDATE EMAIL IF EMAIL SMOKU NULL
            Smoku::where('no_kp' ,$request->no_kp)
            ->update([

            'email' => $request->email,
            
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        
    }
}
