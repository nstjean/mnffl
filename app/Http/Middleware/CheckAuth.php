<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckAuth
{
    /**
     * Checks if user is logged in, continues request if so, displays home view if not
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            return redirect()->action('PostsController@index');
        }
        return $next($request);
    }
}
