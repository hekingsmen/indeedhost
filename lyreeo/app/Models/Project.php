<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use App\Models\ProjectMember;
use App\Models\ProjectDocument;
use Validator;
use Carbon\Carbon;
use App\Models\Role;
use App\User;
use Mail;
use App\Models\ProjectStatus;

class Project extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id";
    protected $fillable = ['project_title', "fk_businessUnitId", "sponsor_name", "sponsor_email", "project_manager", "estimated_start_date",
        "estimated_end_date", "is_public", "is_group", "is_active", "is_archive", "picture", "project_description", "current_situation", "project_objective",
        "prerequisite_dependencies_exclusions", "alternative_or_options", "milestones", "required_resources"];

    public $sortOrder = 'asc';
    public $sortEntity = 'projects.id';

    public function projectBasicDetailsValidation($request)
    {
        $inputs = $request->all();
		if(isset($inputs['estimated_start_date'])){ 
			$inputs['estimated_start_date'] = Carbon::createFromFormat('d/m/y', $inputs['estimated_start_date'])->format('Y-m-d');
		}
		if(isset($inputs['estimated_end_date'])){
				$inputs['estimated_end_date'] = Carbon::createFromFormat('d/m/y', $inputs['estimated_end_date'])->format('Y-m-d');
		} 
        $rules =
            ['project_title' => 'required',
            'sponsor_name' => 'required',
          //  'sponsor_email' => 'required',
            'project_manager' => 'required',
            'estimated_start_date' => 'required|before:estimated_end_date',
            'estimated_end_date' => 'required|after:estimated_start_date',
			'fk_businessUnitId' => 'required',
        ];
        if(!isset($inputs['id']) and $inputs['id'] == null) {
            //$rules = $rules + ['fk_businessUnitId' => 'required'];
        }
		//if(isset($inputs['sponsor_email']) and $inputs['sponsor_email'] != ''){
			$rules['sponsor_email'] = 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255';
           
		//}
        return $validator = Validator::make($inputs, $rules);
    }

    public function saveProjectBasicDetails($request)
    {
        $inputs = $request->input();
		if(isset($inputs['estimated_start_date'])){ 
			$inputs['estimated_start_date'] = Carbon::createFromFormat('d/m/y', $inputs['estimated_start_date'])->format('Y-m-d');
		}
		if(isset($inputs['estimated_end_date'])){
				$inputs['estimated_end_date'] = Carbon::createFromFormat('d/m/y', $inputs['estimated_end_date'])->format('Y-m-d');
		} 
		$projectDetails = $this->find($inputs['id']);
        if($request->hasFile('picture')){
            $image = $request->hasFile('picture');
            $folder = 'products/';
            $inputs['picture'] = uploadImage($request->file('picture'),$folder);
        }
       // $inputs['estimated_start_date'] = Carbon::parse($inputs['estimated_start_date'])->format('Y-m-d');
       // $inputs['estimated_end_date'] = Carbon::parse($inputs['estimated_end_date'])->format('Y-m-d');

        if(isset($inputs['is_public'])) {
            $inputs['is_public'] = 1;
        } else{
            $inputs['is_public'] = 0;
        }

        if(isset($inputs['is_group'])) {
            $inputs['is_group'] = 1;
        } else{
            $inputs['is_group'] = 0;
        }

        if(isset($inputs['is_active'])) {
            $inputs['is_active'] = 1;
        } else{
            $inputs['is_active'] = 0;
        }

        $emailDetails = [];
		if( $inputs['id'] == null) {
            $rolesIds = Role::where('alerts', 1)->pluck('id')->toArray();
            $emailDetails = User::whereIn('role', $rolesIds)->orWhere('id', $inputs['project_manager'])->select('name', 'email')->get()->toArray();
        } else{
            if(isset($inputs['sponsor_email']) and $inputs['sponsor_email'] != null){
                if($projectDetails['sponsor_email'] != null) {
                    if($inputs['sponsor_email'] != $projectDetails['sponsor_email']) {
                        $emailDetails[] = ['name'=>$inputs['sponsor_name'], 'email'=>$inputs['sponsor_email'], 'type'=>'sponsor'];
                    }
                } else{
                    $emailDetails[] = ['name'=>$inputs['sponsor_name'], 'email'=>$inputs['sponsor_email'], 'type'=>'sponsor'];
                }
            }
        }
		
        if(!isset($inputs['id']) and $inputs['id'] == null) {
            $rolesIds[] = Role::where('alerts', 1)->pluck('id')->toArray();
            $emailDetails = User::whereIn('role', $rolesIds)->orWhere('id', $inputs['project_manager'])->select('name', 'email')->get()->toArray();
            if(isset($inputs['sponsor_email'])){
                $emailDetails[] = ['name'=>$inputs['sponsor_name'], 'email'=>$inputs['sponsor_email'], 'type'=>'sponsor'];
            }
			$emailDetails[] =  User::where('id', $inputs['project_manager'])->select('name', 'email')->first();;
        }
        $project =  Project::updateOrCreate(['id'=>$inputs['id']], $inputs);
        if($inputs['id'] == null){
           ProjectStatus::updateOrCreate(['fk_projectId'=>$project['id']]);
        }
        // ProjectStatus::updateOrCreate(['fk_projectId'=>$project['id']]);
        if(count($emailDetails) != 0) {
            foreach($emailDetails as $emailDetail) {
				if(isset($emailDetail['type']) and $emailDetail['type'] == 'sponsor' and $inputs['id'] != null) {
					$content = EmailTemplate::find(7);
				} else{
					$content = EmailTemplate::find(2);
				}
                $address = $emailDetail['email'];
                $name = $emailDetail['name'];
                $subject = str_replace('[PROJECT TITLE]', $project->project_title, $content->template_subject);;

                $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
                $email_content = str_replace('[PROJECT TITLE]', $project->project_title, $email_content);
                $email_content = str_replace('[PROJECT LINK]', '<a href="'.url('about/project/'.$project->id).'">'.url('about/project/'.$project->id)."</a>", $email_content);

                $data['test_message'] = $email_content;
                Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
                    $message->to($address, $name)->cc('technodeviser05@gmail.com')->subject($subject);
                });
            }
        }
        return $project;
    }


    public function projectDetailsValidation($request)
    {
        $rules = [
            'project_description' => 'required',
            'current_situation' => 'required',
            'project_objective' => 'required',
            'prerequisite_dependencies_exclusions' => 'required',
            'alternative_or_options' => 'required',
            'milestones' => 'required',
            'required_resources' => 'required'
        ];
        return validator($request, $rules);
    }


    public function updateProjectDetail($request)
    {
        $inputs = $request;
        $projectDetails = $this->find($inputs['id']);
        if($projectDetails == null){
            return "404";
        }

        if($projectDetails->sponsor_email != null || $projectDetails['sponsor_email'] != $inputs['sponsor_email']){
            $this->sendProjectMail($projectDetails);
        }
        unset($inputs['members']);
        unset($inputs['_token']);
        $project = Project::updateOrCreate(['id'=>$inputs['id']], $inputs);



        return "200";
    }

    public function validateProjectDetails($request)
    {
        return $validator = Validator::make($request->all(), [
            'project_title' => 'required',
           // 'fk_businessUnitId' => 'required',
           // 'sponsor_name' => 'required',
            //'sponsor_email' => 'required',
            'project_manager' => 'required',
            'estimated_start_date' => 'required',
            'estimated_end_date' => 'required',
            'project_description' => 'required',
            'current_situation' => 'required',
            'project_objective' => 'required',
            'prerequisite_dependencies_exclusions' => 'required',
            'alternative_or_options' => 'required',
            'required_resources' => 'required',
            'milestones' => 'required',
        ]);
    }

    public function sendProjectMail($project=null){
        if(!empty($project)) {

            $rolesIds= Role::where('alerts', 1)->pluck('id')->toArray();
            $emailDetails = User::whereIn('role', $rolesIds)->select('name', 'email')->get()->toArray();
            if($project['sponsor_email'] != null) {
                $emailDetails[] = ['name'=>$project['sponsor_name'], 'email'=>$project['sponsor_email']];
            }

            
            if(count($emailDetails) > 0){
                $content = EmailTemplate::find(6);
                foreach($emailDetails as $emailDetail) {
                    $address = $emailDetail['email'];
                    $name = $emailDetail['name'];

                    $projectManagerName = User::where('id',$project->project_manager)->pluck('name')->first();
                    $subject       = str_replace('[PROJECT TITLE]', $project->project_title, $content->template_subject);
                    $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
                    $email_content = str_replace('[PROJECT TITLE]', $project->project_title, $email_content);
                    $email_content = str_replace('[PROJECT MANAGER NAME]', $projectManagerName, $email_content);
                    //$email_content = str_replace('[PROJECT LINK]', url('about/project/'.$project->id), $email_content);
                     $email_content = str_replace('[PROJECT LINK]', '<a href="'.url('about/project/'.$project->id).'">'.url('about/project/'.$project->id)."</a>", $email_content);

					
					$data['test_message'] = $email_content;
 
                    Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
                        $message->to($address, $name)->subject($subject);
                    });
 
                }   
            }
 
        }
    }

    public function sendProjectHealthMail($project=null){
        if(!empty($project)) {

            $rolesIds = Role::where('alerts', 1)->pluck('id')->toArray();
            $emailDetails = User::whereIn('role', $rolesIds)->select('name', 'email')->get()->toArray(); 
            if($project['sponsor_email'] != null) {
                $emailDetails[] = ['name'=>$project['sponsor_name'], 'email'=>$project['sponsor_email']];
            }


            if(count($emailDetails) > 0){
                $content = EmailTemplate::find(5);
                foreach($emailDetails as $emailDetail) {
                    $address = $emailDetail['email'];
                    $name = $emailDetail['name'];

                    $projectManagerName = User::where('id',$project->project_manager)->pluck('name')->first();
                    $subject       = str_replace('[PROJECT TITLE]', $project->project_title, $content->template_subject); 
                    $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
                    $email_content = str_replace('[PROJECT TITLE]', $project->project_title, $email_content);
                    $email_content = str_replace('[PROJECT MANAGER NAME]', $projectManagerName, $email_content);
                    $email_content = str_replace('[PROJECT MANAGER NAME]', $projectManagerName, $email_content);
                    $email_content = str_replace('[PROJECT LINK]', "<a href ='".url('about/project/'.$project->id)."'> ".url('about/project/'.$project->id)." </a>", $email_content);
                    $data['test_message'] = $email_content;

                    Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
                        $message->to($address, $name)->cc('technodeviser05@gmail.com')->subject($subject);
                    });

                }
            }

        }
        return "success";
    }
}
