<?php

namespace App\Http\Middleware;

use Closure;
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
        if (!checkRole('admin')) {
            return redirect('/user')->with('error', "You don't have permission to proceed");
        }
        return $next($request);
    }
}
