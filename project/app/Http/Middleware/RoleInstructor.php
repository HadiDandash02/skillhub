<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleInstructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // app/Http/Middleware/RoleInstructor.php
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'instructor') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

}
