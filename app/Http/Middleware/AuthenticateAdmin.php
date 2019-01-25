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
        if (Auth::check()) {
            if (!checkRole('admin')) {
                return redirect()->route('user.list')->with('error', "You don't have permission to proceed");
            }
            return $next($request);
        }
        return redirect()->route('auth.login');
    }
}
