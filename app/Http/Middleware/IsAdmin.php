<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        $user = auth()->user();
        if($user && $user->is_admin == 1){
            return $next($request);
        }
        
        return redirect('home')->with('error',"You don't have admin access.");
        //return redirect('admin/login');
    }
}
