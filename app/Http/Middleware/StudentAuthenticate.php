<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class StudentAuthenticate
{
    
    public function handle($request, Closure $next)
    {
        if (\Auth::guest("student")) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('student/auth/login');
            }
        }
 
        return $next($request);
    }
}
