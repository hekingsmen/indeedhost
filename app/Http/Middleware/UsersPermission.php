<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use App\Models\Routesmanager;
use App\Models\UserPermission;

class UsersPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentroute = $request->route()->getName();
        $checkroute =  Routesmanager::where('route_name',$currentroute)->first();
        $route_id = $checkroute ? $checkroute->id :NULL;
        $user = auth()->user();
        	if($user){
        		$userpermission = UserPermission::where('user_id',$user->id)
                            ->where('route_id',$route_id)->first();
	            if(($user->is_admin == 1) || $userpermission){
                    return $next($request);
                }
        	}
        
        //return back()->with('error',"You don't have access.");
        //return redirect('/')->with('error',"You don't have access.");
        return redirect('admin/login')->with('error',"You don't have access.");
    }
}
