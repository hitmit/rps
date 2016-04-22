<?php

namespace School\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Sentinel;

/**
 * AdminMiddleware
 * 
 * this middleware class use to check user role
 * @author DS 11/01/16
 */
class ParentMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Sentinel::inRole('parent')) {
            return $next($request);
        } else {
            return Redirect::to('/login')
                            ->withErrors('Sorry...! You are not autherised contact to admin');
        }
    }

}
