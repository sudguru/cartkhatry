<?php

namespace App\Http\Middleware;

use Closure;
use App\Userdetail;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $is_admin = Userdetail::where('id', \Auth::id())->first()->is_admin;
        if($is_admin == 0)
        {
            return redirect('/');
        }

        return $next($request);
    }
}
