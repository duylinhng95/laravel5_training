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
        $admin = User::ROLE['ADMIN'];
        $user  = Auth::user()->userRoles->toArray();
        if (!in_array($admin, array_column($user, 'role_id'))) {
            return redirect('/user')->with('error', "You don't have permission to proceed");
        }
        return $next($request);
    }
}
