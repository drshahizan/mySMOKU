<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Models\Smoku;
use session;
use Illuminate\Support\Facades\DB;

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
        $nokp = $request->session()->get('nokp');
        //dd($nokp);



        $smoku = Smoku::all()->where('nokp', $nokp);

        //return view('pages.auth.daftarlayak');
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
            'nokp' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        $user = User::create([
            'nokp' => $request->nokp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
			'tahap' => '1',
            'status' => '1',
            'last_login_at' => \Illuminate\Support\Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);

        //if ($request->email = null){
            DB::table('smoku')->where('nokp' ,$request->nokp)
            ->update([

            'email' => $request->email,
            
        ]);
        //}

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        
    }
}
