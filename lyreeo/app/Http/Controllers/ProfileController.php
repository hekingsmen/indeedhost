<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Mailer,Mail;
use Validator;
use App\User;
use App\Models\Role;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
    	if(!Auth::check()){
    		redirect()->route('login');
    	}
     	$userData = User::where('id',Auth::user()->id)->first(); 
     		$userData->role = Role::where('id',Auth::user()->role)->pluck('name')->first();
     		
     	if(empty($userData)){
     		return 404;
     	}
     	return view('backend/my_profile',compact('userData'));
    }

    
    public function resetPassword(Request $request){
		if( !empty($request->input('old_password')) ) {
			if (!Hash::check($request->old_password, Auth::user()->password)) { 
				 $errors['old_password'][0] = 'Invalid Credentials';	
				 return webResponse(false, 206, $errors);
			}
		}
        
        if( !empty($request->input('old_password')) || !empty($request->input('password')) || !empty($request->input('password_confirmation')) ) {
            $rules = [
                'old_password' => 'required',
                'password' => 'required',
                'job_title' => 'nullable',
                'password_confirmation' => 'required|same:password',
            ];
        }else{
            $rules = [
                'job_title' => 'nullable',
            ];
        }

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()){
            return webResponse(false, 206, $validation->getMessageBag());
        }else{
			
        	$inputs = $request->input();

			if($request->hasFile('image')){

				$status = uploadImage($request->file('image'),"avatar");
				if($status){ $old_image = $status; }

			}else{ 

                $old_image=null;
            } 
            
        	$response = (new User)->validatePassword($inputs, $old_image);
			$extra['redirect'] = url('admin/profile');
         	if($response){
                    if($response==400){
                        return webResponse(false, 207, __('sentence.current_password_incorrect'));
                    }else{
                        if(isset($inputs['password'])  and $inputs['password'] != ""){
                            return webResponse(true, 200, __('sentence.password_changed'), $extra);
                        } else{
                            return webResponse(true, 200, __('sentence.profile_updated'), $extra);
                        }
                    }
        	}else{
        		return webResponse(false, 207, __('message.server_error'));
        	}
        }

    }


    public function updateLanguage($locale)
    {
        if(Auth::check()) {
            //User::where('id',Auth::user()->id)->update(['language'=>$locale]);
        }
        $duration = 12*24*60*60;
        \Cookie::queue('locale', $locale, $duration);
        return redirect()->back();
    }
}