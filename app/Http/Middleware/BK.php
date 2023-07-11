<?php

namespace App\Http\Middleware;

use Closure;

class BK
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
        if ($request->user()->role != 'BK') {
            return redirect('/');
        }
        return $next($request);
    }
}