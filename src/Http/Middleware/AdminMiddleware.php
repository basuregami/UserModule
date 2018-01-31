<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    /**
     * Handle an incoming request. User must be logged in to do admin check
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (\Auth::attempt(['email' => $request->login, 'user_type' => 1, 'status' => 1])) {
            return $next($request);
        } elseif (\Auth::attempt(['username' => $request->login, 'user_type' => 1, 'status' => 1])) {
            return $next($request);
        }

        return redirect('/console');
    }
}
