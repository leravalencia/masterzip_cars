<?php

namespace App\Http\Middleware;

use Closure;

class Partner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\auth()->user()->partner && !\auth()->user()->admin) {
            \Log::notice('User trying go to partner zone ' . \var_export(\auth()->user(), true));
            \abort(403);
        }

        return $next($request);
    }
}
