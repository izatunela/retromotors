<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if (Auth::check() && auth()->user()->isAdmin()) {
	        return $next($request);
    	}
    	return redirect('login')->with(['error'=>'nisi admin']);
    }
}
