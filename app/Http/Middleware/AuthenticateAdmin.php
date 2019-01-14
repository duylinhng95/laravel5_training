<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Entities\User;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role != User::STATUS['ADMIN']) {
            return redirect('/user')->with('error', "You don't have permission to proceed");
        }
        return $next($request);
    }
}
