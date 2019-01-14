<?php

namespace App\Http\Middleware;

use App\Entities\User;
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
        if ($user->status != User::STATUS['BLOCK']) {
            return $next($request);
        } else {
            return redirect('/user')->with('error', 'You have been blocked to post');
        }
    }
}
