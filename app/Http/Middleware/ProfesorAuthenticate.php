<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ProfesorAuthenticate
{
    
    public function handle($request, Closure $next)
    {
        if (\Auth::guest("profesor")) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('profesor/auth/login');
            }
        }
 
        return $next($request);
    }
}
