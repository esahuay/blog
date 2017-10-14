<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ProfesorGuest
{
    
    public function handle($request, Closure $next)
    {
        if (\Auth::check('profesor')) {
            return redirect('/profesor/home');
        }
 
        return $next($request);
    }
}
