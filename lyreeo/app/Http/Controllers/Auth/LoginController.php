<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected function redirectTo()
    {   
        $extra='reload';
        // $extra=array('reload');
        
        // return '/';
        return webResponse(true, 200, 'Login Successfully.',$extra);
    }

    /**
     * Create a new controller instance.
     *
     * @return void Auth::login($user, true);
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
	public function guestUserLogin($token){ 
	    if($token == "1cbf4873378ad51a66c36ccb421b2d452547ffebd4faaecab74576c234ce4d6a"){
			$user = User::where('role',2)->first(); //guest id = 2
			$remember = true;
			Auth::login($user, $remember);
		}
		return redirect(url('/'));
	}	

    public function loginUser(Request $request){
		$input = $request->input();
		
         $rules = [
            'email'=>'required|string',
            'password' => 'required|string',
        ];
        $validation = Validator::make($request->all(), $rules);
			if ($validation->fails())
			{
				return webResponse(false, 206, $validation->getMessageBag());
			}
        
             $auth = false;
            $credentials = $request->only('email', 'password');
            $duration = 12*24*60*60;
			if(isset($input['remember'])) {
				\Cookie::queue('email', $credentials['email'], $duration);
				\Cookie::queue('password', $credentials['password'], $duration);
				\Cookie::queue('remember', $input['remember'], $duration);
			} else{
				\Cookie::queue(\Cookie::forget('remember'));
			}
        
            if (Auth::attempt($credentials, $request->has('remember'))) { 
                $extra['redirect'] = url('/');
		         \Cookie::queue('locale', \Auth::user()->language, $duration);
                return webResponse(true, 200, __('sentence.successfull_login'), $extra);
            } else{
                $user = User::where('email', $credentials['email'])->first();
                if($user != null){
                    $errors['password'][0] = 'Invalid Credentials';
                } else{
                    $errors['email'][0] = 'Invalid Credentials';
                }

                return webResponse(false, 206, $errors);
            }
             
    }

    public function logout(Request $request)
    {
			
		$message =  __('sentence.successfull_logout');
		$email = $request->cookie('email');
		$locale = $request->cookie('locale');
		$password = $request->cookie('password');
		$remember = $request->cookie('remember');
		$authEmail =  Auth::user()->email;
		//echo $remember;die;;
        \Auth::logout();

        $request->session()->invalidate();
		
        $request->session()->regenerateToken();
	
		if(!$remember and strtolower($authEmail) == strtolower($email)) { 
			\Cookie::queue(\Cookie::forget('remember'));
			\Cookie::queue(\Cookie::forget('email'));
			\Cookie::queue(\Cookie::forget('password'));
		}
	    
		//\Cookie::queue(\Cookie::forget('locale'));
		 Session::flash('success',$message);
		 $duration = 12*24*60*60;
		 //\Cookie::queue('locale', $locale, $duration);
		if($remember){
			
			// \Cookie::queue('email', $email, $duration);
			// \Cookie::queue('password', $password, $duration);
			//\Cookie::queue('remember', $remember, $duration);
		}
        return redirect('/');
    }


}
