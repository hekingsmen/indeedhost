<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\ProjectDocument;
use App\Models\ProjectMember;
use App\Models\ProjectStatus;
use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use App\Models\Project;
use Response;
use App\User;
use Auth;
use File;
use Carbon\Carbon;
 
class HomeController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

	public function login(){
		return view('frontend.login');
	} 
    
    public function index(Request $request){
		if(!Auth::user()){
			 return view('frontend.login');
		}  
		
        $totalProjects = 0;
        $locate = "";
        $department = BusinessUnit::where('is_hidden',0)->orderBy('department_name', 'asc')->get();

        if(!empty($department)){
            foreach ($department as $key => $value) {
                $value->project_count  = $this->getAllCountProject($value->id);
            }
        }

        $totalProjects = $this->getAllCountProject();
        
        return view('frontend.homepage',compact('department','totalProjects','locate'));
    }


    public function projectOverview($id=null){

        $locate = "";
        $isFrontEndValid='';
        $department = BusinessUnit::where(['id'=>$id,'is_hidden'=>0])->first();
        if(empty($department) ){
            return redirect()->back();
        }
        $today = Carbon::today()->format('Y-m-d');
        if(Auth::user()){
            $isFrontEndValid = validateFullFrontEndView(Auth::user()->role,"front_end_view_panel");
                if($isFrontEndValid==1){
                    $conditions = array( 'fk_businessUnitId'=>$department->id, 'is_active'=>1, );
                }else{ 
                    $conditions = array( 'fk_businessUnitId'=>$department->id, 'is_active'=>1, 'is_public'=>1 ); 
                }
            $projects = Project::where($conditions);//->orderBy('project_title', 'asc')->get()
        }else{
            $projects = Project::where(['fk_businessUnitId'=>$department->id,'is_active'=>1,'is_public'=>1]);//->orderBy('project_title', 'asc')->get();
        }
        $projects = $projects->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->select('projects.*', \DB::raw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date ELSE projects.estimated_end_date END AS projectEndDate'))
            ->whereRaw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date >= "'.$today.'" ELSE projects.estimated_end_date >= "'.$today.'" END')
            ->orderBy('project_title', 'asc')->get();
        foreach ($projects as $key => $project) {
            $project->status = ProjectStatus::where('fk_projectId',$project->id)->first();
            if(!empty($project->project_manager)){
                //$project->avatar = User::where('id',$project->project_manager)->pluck('avatar')->first();
                $user = User::where('id',$project->project_manager)->first(['name', 'avatar']);
                $project->avatar = $user['avatar'];
                $project->project_manager_name = $user['name'];
            }
        }
        $locate = ucfirst($department->department_name);
        $titleName = $department->department_name;
        return view('frontend.project_overview',compact('projects','department','isFrontEndValid','isFrontEndValid','locate','titleName'));
    }


    public function allProjectsViews(){
		$segment = request()->segment(1);
        $locate = "";
        $isFrontEndValid='';
        $department=array();
        $businesUnitId= array();
        $businessUnitIds = BusinessUnit::where('is_hidden', 0)->pluck('id')->toArray();
        $today = Carbon::today()->format('Y-m-d');
        if(Auth::user()){
            $isFrontEndValid = validateFullFrontEndView(Auth::user()->role,"front_end_view_panel");
			if($isFrontEndValid==1){
                $conditions = array('is_active'=>1, );
            }else{ 
                $conditions = array('is_active'=>1, 'is_public'=>1 );
            }
            $projects = Project::where($conditions)->whereIn('fk_businessUnitId',$businessUnitIds);
        }else{
            $projects = Project::where(['is_active'=>1,'is_public'=>1])->whereIn('fk_businessUnitId',$businessUnitIds);
        }
        if($segment == "all") {
			$projects = $projects->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->select('projects.*', \DB::raw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date ELSE projects.estimated_end_date END AS projectEndDate'))
            ->whereRaw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date >= "'.$today.'" ELSE projects.estimated_end_date >= "'.$today.'" END')
            ->orderBy('project_title', 'asc')->get();
			  $locate = __('sentence.all_project');
		} else {
			if(Auth::user()) { 
			    $conditions = array();
				if($isFrontEndValid==1){
					$conditions = array();
					//$conditions = array('is_active'=>1 );
				}else{ 
					$conditions = array( 'is_public'=>1 );
				//	$conditions = array('is_active'=>1, 'is_public'=>1 );
				}
			} else {
				//$conditions = array('is_active'=>1, 'is_public'=>1 );
				$conditions = array('is_public'=>1 );
			}
			
			$projects = Project::where(function($query) use($conditions,$today) {
							  $query->where($conditions)
							   ->where(function($query1) use ($today){
									$query1->whereRaw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date < "'.$today.'" ELSE projects.estimated_end_date < "'.$today.'" END')->where('is_active', 1)
									->orWhere('is_archive','=',1);
								});
							});
			
			$projects = $projects->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->select('projects.*', \DB::raw('case WHEN project_status.realistic_end_date IS NOT NULL THEN project_status.realistic_end_date ELSE projects.estimated_end_date END AS projectEndDate'))
           
            ->orderBy('project_title', 'asc')->get();
			  $locate = __('sentence.frontend_archived_projects');
		} 
        

        foreach ($projects as $key => $project) {
            $project->status = ProjectStatus::where('fk_projectId',$project->id)->first();
            if(!empty($project->project_manager)){
                $user = User::where('id',$project->project_manager)->first(['name', 'avatar']);
                $project->avatar = $user['avatar'];
                $project->project_manager_name = $user['name'];
            }

        }
      
        $forBackLink="fromAllProject";
        return view('frontend.project_overview',compact('projects','department','isFrontEndValid','locate','forBackLink'));
    }


    public function aboutProject($id=null){
        $locate = "";
        $isFrontEndValid='';
        if(Auth::user()){
            $isFrontEndValid = validateFullFrontEndView(Auth::user()->role,"front_end_view_panel");
        }
        $projectDetail = Project::where('id',$id)->first();
		if($projectDetail['is_public'] == 0 and $isFrontEndValid == 0){
			return redirect(url('all/project'));
		}
        $projectDetail->status = ProjectStatus::where('fk_projectId',$projectDetail->id)->first();
        $projectDetail->project_manager = User::where('id',$projectDetail->project_manager)->first(['name','avatar', 'job_title']);
        $projectDetail->members = ProjectMember::where(['fk_projectId'=>$projectDetail->id])->get();
        if(!empty($projectDetail->members)){
             foreach ($projectDetail->members as $key => $value) {
                $value->name = $value->fk_username;
             }
        }
        $locate = $projectDetail->project_title;

        if(!empty($projectDetail->members)){
			//rsort($projectDetail->members->toarray());
            $allMembers = '';
            $members= array();
            foreach ($projectDetail->members as $key => $value) {
                $members[] = ucfirst($value->name);
            }
			asort($members);
            $allMembers = implode( ', ', $members );
        }

        // if document doesnt exist - deleted
        $testTheFile = ProjectDocument::where('fk_projectId',$projectDetail->id)->get();
        if(!empty($testTheFile)){
            $document='';
            foreach ($testTheFile as $key => $value) {
                $document = $value->document;
                $exists = Storage::disk('loapp')->exists($document);
                if(!$exists){
                    ProjectDocument::where(['fk_projectId'=>$id,'document'=>$document])->delete();
                }
            }
        }
        $projectDetail->files = ProjectDocument::where(['fk_projectId'=>$projectDetail->id])->get();
        return view('frontend.project_detail',compact('projectDetail','isFrontEndValid','locate','members','allMembers'));
    }


    public function getPubliclyStorgeFile($filename){
        $path = storage_path('app/images/avatar/'. $filename);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        
        return $response;
    }


    public function getPubliclyStorgeProductFile($filename){
        $path = storage_path('app/images/products/'. $filename);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        
        return $response;   
    }

    public function getDownloadFile($id=null){
        $document =  ProjectDocument::where(['id'=>$id])->pluck('document')->first();
        $exists = Storage::disk('loapp')->exists($document);
        
        if($exists){
            if(!empty($document)){
                $extentionName = explode('.',$document)[1];
                $file= Storage::path('images/documents/').$document;
                    $headers = array(
                            'Content-Type: application/javascript',
                            );
                return Response::download($file,$document, $headers);
            }
        }else{
            // return webResponse(true, 200, 'File does not exists.');
            return redirect()->back();
        }

    }

    public function getAllCountProject($businesUnitId=null){
        if($businesUnitId != null){
            $businessUnitIds[] = $businesUnitId;
        } else{
             $businessUnitIds = BusinessUnit::where('is_hidden', 0)->pluck('id')->toArray();
        }
       

        if(Auth::user()){
            $isFrontEndValid = validateFullFrontEndView(Auth::user()->role,"front_end_view_panel");
            if($isFrontEndValid==1){
                $conditions = array('is_active'=>1, );
            }else{ 
                $conditions = array('is_active'=>1, 'is_public'=>1 );
            }
            $projects = Project::where($conditions)->whereIn('fk_businessUnitId',$businessUnitIds)->get();
        }else{
            $projects = Project::where(['is_active'=>1,'is_public'=>1])->whereIn('fk_businessUnitId',$businessUnitIds)->get();
        }
        foreach ($projects as $key=>$project) {
			$projectStatus = ProjectStatus::where('fk_projectId', $project->id)->select('real_start_date', 'realistic_end_date')->first();
            $startDate = $project->estimated_start_date;
			$endDate = $project->estimated_end_date;
			$today = Carbon::today();
			if(isset($projectStatus['real_start_date']) and $projectStatus['real_start_date'] != null) {
				$startDate = $projectStatus['real_start_date'];
				$endDate = $projectStatus['realistic_end_date'];
			}
			$diff =  strtotime($endDate) - strtotime($today);
			if($diff < 0){ 
			 if($project->id == 28){
				//echo $project->id.$project->status->real_start_date .'-'.$project->status->realistic_end_date.'<br>';
			 }
				unset($projects[$key]);
			}
        }
		
        return count($projects);
    }
    

}
