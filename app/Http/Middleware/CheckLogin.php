<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            return $next($request);
        }

        return redirect(route('login'));
    }
}
