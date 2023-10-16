<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if ($token !== 'Bearer $2y$10$Z3G62BSNYWxngrA1iPH0ouXYxzUWnyBWXWabo.wVmThXdNMdrFTCq') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

