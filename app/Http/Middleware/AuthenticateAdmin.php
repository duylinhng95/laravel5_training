<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        $auth = Auth::guard('admin');
        if (!$auth->check()) {
            return redirect()->route('admin.login');
        } else {
            $user = $auth->user();
            if ($user->checkRole('admin')) {
                return $next($request);
            } else {
                $auth->logout();
                return redirect()->route('admin.login')->with('error', "You don't have permission to proceed");
            }
        }
    }
}
