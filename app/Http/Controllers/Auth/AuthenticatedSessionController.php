<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TarikhIklan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/sign-in/general.js');
        try {
            // Try to retrieve the latest 'catatan'
            $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
            $catatan = $iklan->catatan ?? "";
    
            return view('pages.auth.login', compact('catatan'));
        } catch (QueryException $e) {
            // Log the error message or handle the exception
            Log::error("Database connection failed: " . $e->getMessage());
    
            // Optionally, display a custom error message to the user
            return view('pages.auth.login', ['catatan' => 'Sambungan ke pangkalan data gagal. Sila cuba lagi kemudian.']);
        }
        
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('refresh', true);
    }
}
