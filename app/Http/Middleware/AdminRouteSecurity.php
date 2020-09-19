<?php

namespace App\Http\Middleware;

use Closure;

class AdminRouteSecurity
{

    public function handle($request, Closure $next)
    {
        if (\Auth::user()->id == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
