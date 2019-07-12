<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BackendLogin
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
        if(empty(Auth::user()->admin)) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
