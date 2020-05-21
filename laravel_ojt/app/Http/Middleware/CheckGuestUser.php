<?php

namespace App\Http\Middleware;

use Closure;

class CheckGuestUser
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
        if(auth()->user()){
            if (auth()->user()->type == config('constants.admin') || auth()->user()->type == config('constants.user')) {
                return $next($request);
            }
        } else {
            return redirect(route('posts.index'));
        }
        
    }
}
