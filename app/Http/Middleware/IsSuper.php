<?php

namespace App\Http\Middleware;

use Closure;
use App\Userdetail;

class IsSuper
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
        $is_super = Userdetail::where('id', \Auth::id())->first()->is_super;
        if($is_super == 0)
        {
            return redirect('/');
        }

        return $next($request);
    }
}
