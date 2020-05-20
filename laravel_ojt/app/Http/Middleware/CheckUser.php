<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (auth()->user()->type == config('constants.user') && auth()->user()->id == $request->route('user')->id) {
            return $next($request);
        }
        return redirect(route('posts.index'))->with('status', 'You don\'t have permission');
    }
}
