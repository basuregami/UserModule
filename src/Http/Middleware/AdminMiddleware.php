<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{


    public function handle($request, Closure $next)
    {
        
        if (\Auth::attempt(['email' => $request->login, 'password' =>$request->password, 'user_type' => 1, 'status' => 1]))
        {
            
            return $next($request);

        }elseif ( \Auth::attempt(['username' => $request->login, 'password' =>$request->password, 'user_type' => 1, 'status' => 1])) {

            return $next($request);
        }
        
        return redirect()->back()->with('status', 'Invalid Login');
      
    }
}