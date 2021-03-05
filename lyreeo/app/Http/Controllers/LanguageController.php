<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Request;
use Response;
 
class LanguageController extends Controller
{ 
	 public function langChange($lang=null){
	 	$pat = Request::url();

	 	if (! in_array($lang, ['EN', 'DE', 'FR'])) {
        		
    	}

  		// $response = new Illuminate\Http\Response('Hello World');
		// $response->withCookie(cookie()->forever('lang', $lang));

		$res = \App::setLocale('fr');
		
		return redirect()->back();
	 }
}