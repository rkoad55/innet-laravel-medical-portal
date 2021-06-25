<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthDoctors
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
        if (false == Auth::guard('doctor')->check()) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
