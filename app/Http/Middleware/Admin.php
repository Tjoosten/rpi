<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if ($request->ajax()) {
            response('not permitted', 403);
        }

        if (Auth::check()) {
            if (Auth::user()->role == 'A') {
                return $next($request);
            } else {
                return Redirect::back();
            }
        }
    }
}
