<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Closure;
use Auth;

class Locale
{

    public function handle($request, Closure $next){
       \App::setlocale($request->cookie('locale'));
        return $next($request);
    }


}
