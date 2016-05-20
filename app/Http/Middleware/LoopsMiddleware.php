<?php

namespace App\Http\Middleware;

use Closure;

class LoopsMiddleware
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
        sleep(2);
        return $next($request);
    }
}
