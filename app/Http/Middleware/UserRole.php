<?php

namespace App\Http\Middleware;

use Closure;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles_id)
    {
        if( in_array($request->user()->role_id, $roles_id) ){
           return $next($request); 
        }
        return redirect('/');
    }
}