<?php 

namespace School\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Sentinel;

/**
 * AuthMiddleware
 * 
 * this middleware class use to check login status
 * @author DS 11/01/16
 */
class AuthMiddleware
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
        if (Sentinel::check()) {
            return $next($request);
        } else {
            return Redirect::to('login')
                ->withErrors('Please login first');
        }
    }
}
