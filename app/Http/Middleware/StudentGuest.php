<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class StudentGuest
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check('student')) {
            return redirect('/student/home');
        }
 
        return $next($request);
    }
}
