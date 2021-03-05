<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;
use App\Models\Role;

class UsersPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
 
    public function handle($request, Closure $next,$module=null)
    {
        if(!empty($module)){
            $validate = Role::where('id',Auth::user()->role)->pluck($module)->first();

            if($validate!=1){
				return redirect('admin/profile');
                return webResponse(false, 207, __("You don't have Access permission"));
            }else{
                return $next($request);    
            }
        }else{
            return webResponse(false, 207, __("You don't have Access permission"));
        }
    }
}
