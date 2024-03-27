<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\facades\Auth;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(Auth::user()->role == 'admin')
        {
          return $next($request);   
        }
        else{

           return redirect('/');
        } 
        
    }
}
