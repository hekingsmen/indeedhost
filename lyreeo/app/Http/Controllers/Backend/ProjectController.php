<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\Mail\Mailer;
use Validator;
use Mail;
use DB;
use App\User;
use App\Models\EmailTemplate;
use Carbon\Carbon;
use App\Models\ProjectMember;
use App\Models\ProjectDocument;
use Storage;
use App\Exports\ProjectsExport;
use Excel;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $sortOrderActive = $sortOrderInActive = (new Project)->sortOrder;
        $sortEntityActive = $sortEntityInActive = (new Project)->sortEntity;

        $result = null;
        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder)) {
            if(isset($request->container_type) and $request->container_type == 'in_active_projects'){
                 $sortEntityInActive = $request->sortEntity;
                 $sortOrderInActive = $request->sortOrder;
                $view = 'inactive_pagination';
            } else{
                 $sortEntityActive = $request->sortEntity;
                 $sortOrderActive = $request->sortOrder;
                 $view = 'active_pagination';
            }
        }
        $activeProjects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->where('projects.is_active', 1)->select('projects.*', 'business_units.department_name', 'users.name as project_manager_name')
            ->orderBy($sortEntityActive, $sortOrderActive)->get();

        $inActiveProjects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->where('projects.is_active', 0)->where('projects.is_archive', 0)->select('projects.*', 'business_units.department_name', 'users.name as project_manager_name')
            ->orderBy($sortEntityInActive, $sortOrderInActive)->get();

        $businessUnits = BusinessUnit::pluck('department_name', 'id')->toArray();

        $projectManagers = (new User)->projectManagers();
        return view('backend.projects.'.$view, compact('activeProjects','businessUnits', 'inActiveProjects', 'projectManagers', 'sortOrderActive', 'sortEntityActive', 'sortOrderInActive', 'sortEntityInActive'));
    }

    public function saveProjectBasicDetails(Request $request)
    {
        $validation = (new Project)->projectBasicDetailsValidation($request);
        if($validation->fails()) {
			 $inputs = $request->input();
			
				$extra['message'] = __('sentence.project_detail_manage.details_not_saved');
			 
            return webResponse(false, 206, $validation->getMessageBag(), $extra);
        }
        try
        {
            \DB::beginTransaction();

            (new Project)->saveProjectBasicDetails($request);
			
            \DB::commit();
			$extra['redirect'] = url('admin/projects');
            return webResponse(true, 200, __('sentence.project_manage.successfully_saved'), $extra);
        } catch (\Exception $e)
        {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'.$e));
        }
    }

    public function archivedProjects(Request $request)
    {
        $sortOrderArchive = (new Project)->sortOrder;
        $sortEntityArchive = (new Project)->sortEntity;

        $result = null;
        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder)) {
            $sortEntityArchive = $request->sortEntity;
            $sortOrderArchive = $request->sortOrder;
            $view = 'pagination';
        }
        $archivedProjects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')->where('projects.is_archive', 1)
            ->select('projects.*', 'business_units.department_name', 'users.name as project_manager_name')
            ->orderBy($sortEntityArchive, $sortOrderArchive)->get();
        return view('backend.projects.archive.'.$view, compact('archivedProjects','sortOrderArchive', 'sortEntityArchive'));

    }

    public function deleteProjectBasicDetails(Request $request, $projectId)
    {   
        $project = Project::find($projectId);
        if($project != null and $project['is_active'] == 0) {
            ProjectStatus::where('fk_projectId', $projectId)->delete();
            ProjectMember::where('fk_projectId', $projectId)->delete();
            $projectDocuments = ProjectDocument::where('fk_projectId', $projectId)->get();

            foreach($projectDocuments as $projectDocument) {
                $document = $projectDocument['document'];
                if(\File::exists(Storage::path('images/documents/').$document) && !empty($document) ){
                    \File::delete(Storage::path('images/documents/').$document);
                }
            }

            ProjectDocument::where('fk_projectId', $projectId)->delete();
            $project->delete();
        }
        return webResponse(true, 200, __('sentence.project_manage.deleted'));
    }

    public function projectsStatus(Request $request)
    {
        $sortOrder = (new Project)->sortOrder;
        $sortEntity = (new Project)->sortEntity;
        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder))
        {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $view = 'pagination';
        }
        $all_projects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->where('projects.is_active', 1)
            ->select('projects.*', 'business_units.department_name', 'project_status.current_quality as current_status','project_status.updated_at as project_status_updated_at', 'project_status.cost_situation as cost_status', 'project_status.time_planning as time_status','project_status.current_quality_explanation as current_quality_explanation','project_status.cost_situation_explanation as cost_situation_explanation','project_status.time_planning_explanation as time_planning_explanation')
            ->orderBy($sortEntity, $sortOrder)->get();
        $oneweekAgo = Carbon::today()->subWeek()->format('Y-m-d');
        return view('backend.projects.status.'.$view,compact('all_projects', 'sortOrder', 'sortEntity', 'oneweekAgo'));
    }

    public function sendReminder(Request $request)
    {
        $inputs = $request->input();
        $where = 1;
        if($inputs['project_id'] == 'all') {
			$oneweekAgo = Carbon::today()->subWeek()->format('Y-m-d');
			$where .= " AND (project_status.updated_at <= ". $oneweekAgo." or project_status.updated_at Is Null)";
        } else{
            $where .= " AND projects.id = ". $inputs['project_id'];
        }

        $projectDetails = Project::leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->select('projects.project_title','projects.id', 'users.name', 'users.email', 'project_status.updated_at as project_last_update')
			->whereRaw($where)
            ->get();  
        foreach($projectDetails as $projectDetail){
            $content = EmailTemplate::find(3);
            // $address = "technodeviser05@gmail.com";
            $address = $projectDetail->email;
            $subject = $content->template_subject;
            $name = $projectDetail->name;
            $subject       = str_replace('[PROJECT TITLE]', $projectDetail->project_title, $content->template_subject);

            $content = str_replace('[PROJECT TITLE]',$projectDetail->project_title,$content->template_content);
            $content = str_replace('[PROJECT MANAGER NAME]',$projectDetail->name,$content);
            $content = str_replace('[PROJECT LINK]', "<a href ='".url('/admin/project/status/'.$projectDetail->id)."'> ".url('/admin/project/status/'.$projectDetail->id)." </a>", $content);
            $data['test_message'] = $content;
            Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
                $message->to($address, $name)->cc('technodeviser05@gmail.com')->subject($subject);
            });

        }


        return webResponse(true, 200,  __('sentence.project_status.reminder_sent'));
    }

    public function editProject($projectId=null)
    {
		$data['businessUnits'] = BusinessUnit::pluck('department_name', 'id')->toArray();

        $data['projectManagers'] = (new User)->projectManagers();
        $data['projectDetails'] = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')->where('projects.id', $projectId)
			->select('projects.*', 'business_units.department_name', 'users.name as project_manager_name')->first();
        return view('backend.projects.edit', $data);
    }

    public function archiveProject(Request $request)
    {
        $input = $request->input();
        $project = Project::find($input['id']);

        if(!$project) {
            $message = __('sentence.project_not_found');
            return webResponse(false, 207, $message);
        }
        try
        {
            \DB::beginTransaction();
            $projectData = ['is_archive' => (bool) !$project->is_archive];

            $project->update($projectData);
            \DB::commit();

            return webResponse(true, 200, '');
        } catch (\Exception $e)
        {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'));
        }
    }

    public function doneButActive(Request $request)
    {
        $sortOrder = (new Project)->sortOrder;
        $sortEntity = (new Project)->sortEntity;

        $result = null;
        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder)) {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $view = 'pagination';
        }
        $today = Carbon::today()->format('Y-m-d');
        $doneProjects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->where('projects.is_active', 1)
            ->select('projects.*', 'business_units.department_name', 'users.name as project_manager_name','project_status.realistic_end_date', 'project_status.real_start_date',
               DB::raw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date ELSE projects.estimated_end_date END AS projectEndDate'))
            ->whereRaw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date < "'.$today.'" ELSE projects.estimated_end_date < "'.$today.'" END')
            ->orderBy($sortEntity, $sortOrder)->get();
        return view('backend.projects.done.'.$view, compact('doneProjects','sortOrder', 'sortEntity'));
    }

    public function informDoneButActive(Request $request)
    {
        $inputs = $request->input();
		$today = Carbon::today()->format('Y-m-d');
        $where = 1;
		$projectDetails = Project::leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->select('projects.project_title','projects.id', 'users.name', 'users.email');
        if($inputs['project_id'] == 'all') {
            $oneweekAgo = Carbon::today()->subWeek()->format('Y-m-d');
           $projectDetails = $projectDetails->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')->whereRaw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date < "'.$today.'" ELSE projects.estimated_end_date < "'.$today.'" END')->where('projects.is_active', 1);
        } else{
			 $projectDetails = $projectDetails->where('projects.id', $inputs['project_id']);
            
        }

        $projectDetails = $projectDetails->get();

        foreach($projectDetails as $projectDetail){
            $content = EmailTemplate::find(8);
           
            $address = $projectDetail->email;
            $subject = $content->template_subject;
            $name = $projectDetail->name;
            $subject       = str_replace('[PROJECT TITLE]', $projectDetail->project_title, $content->template_subject);

            $content = str_replace('[PROJECT TITLE]',$projectDetail->project_title,$content->template_content);
            $content = str_replace('[RECEIVER NAME]',$projectDetail->name,$content);
            $content = str_replace('[PROJECT LINK]', "<a href ='".url('/admin/project/status/'.$projectDetail->id)."'> ".url('/admin/project/status/'.$projectDetail->id)." </a>", $content);
            $data['test_message'] = $content;
            Mail::send('emails.test', $data, function($message) use($address, $name, $subject) {
                $message->to($address, $name)->cc('technodeviser05@gmail.com')->subject($subject);
            });

        }

        return webResponse(true, 200,  __('sentence.project_status.informed'));
    }

    public function exportProjects(Request $request)
    {
		$locale = $request->cookie('locale');
		if($locale == ""){
			$locale = "EN";
		}
		$today = Carbon::today()->format('Y_m_d');
		$fileName = $today.'_LPRT_Projects_Export_'.strtoupper($locale).'.xlsx';
        return  $excelGenerated =  Excel::download(new ProjectsExport, $fileName);
    }
}
