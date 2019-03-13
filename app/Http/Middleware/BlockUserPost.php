<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BlockUserPost
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
        $user = Auth::user();
        if ($user->checkStatus()) {
            return $next($request);
        } else {
            return redirect()->route('user.index')->with('error', 'You have been blocked to post');
        }
    }
}
