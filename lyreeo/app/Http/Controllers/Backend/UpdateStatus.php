<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\EmailTemplate;
use Mail;

class UpdateStatus extends Controller
{
    public function index(){
    	$all_projects = Project::leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')->select('projects.*', 'project_status.current_quality as current_status', 'project_status.cost_situation as cost_status', 'project_status.time_planning as time_status','project_status.current_quality_explanation as current_quality_explanation','project_status.cost_situation_explanation as cost_situation_explanation','project_status.time_planning_explanation as time_planning_explanation')->where('projects.is_active','=',"1")->get();
        foreach ($all_projects as $key => $value) {
            $value->fk_businessUnitId = BusinessUnit::where('id',$value->fk_businessUnitId)->pluck('department_name')->first();
        }
        return view('backend.update_status',compact('all_projects'));
    }

     public function sendMail(){
        $data['test_message'] = "testing email";
        $status = Mail::send('emails.test', $data, function($message)  {
            $message->to('technodeviser05@gmail.com', 'nisha')->subject('test');
        });
    	dd($status);
    }
}