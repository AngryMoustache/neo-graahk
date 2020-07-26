<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->admin) {
            return $next($request);
        }

        return redirect(route('static.home'));
    }
}
