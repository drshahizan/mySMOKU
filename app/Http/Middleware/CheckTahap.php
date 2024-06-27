<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTahap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $tahap
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $tahap)
    {
        $user = Auth::user();
        $allowedTahaps = explode(',', $tahap);

        if (!$user || !in_array($user->tahap, $allowedTahaps)) {
            return redirect('/unauthorized')->with('error', 'Tidak dibenarkan.');
        }

        return $next($request);
    }

}
