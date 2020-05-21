<?php

namespace App\Http\Middleware;
use App\Models\Post;
use Closure;

class CheckRoleForPostEdit
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
            $post = Post::find($request->route('post')->id);
            if (auth()->user()->type == config('constants.admin') || (auth()->user()->type == config('constants.user') && auth()->user()->id == $post->create_user_id)) {
                return $next($request);
            }
            return redirect(route('posts.index'))->with('status', 'You don\'t have permission');
        } else {
            return redirect(route('posts.index'));
        }
    }
}
