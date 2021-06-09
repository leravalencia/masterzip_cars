<?php

namespace App\Http\Middleware;

use Closure;

class ThrowErrorIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->admin) {
            abort(403, 'Not Allowed');
        }
        return $next($request);
    }
}
