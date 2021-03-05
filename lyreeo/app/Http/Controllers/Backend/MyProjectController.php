<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\ProjectDocument;
use App\Models\ProjectStatus;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\Roles;
use Carbon\Carbon;
use Validator;
use App\User;
use Response;
use Auth;
use DB;

class MyProjectController extends Controller
{
    public function myProjects(Request $request) {
        $sortOrder = (new Project)->sortOrder;
        $sortEntity = (new Project)->sortEntity;
        $view = 'myproject';
        if(isset($request->sortEntity) and isset($request->sortOrder))
        {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $view = 'pagination';
        }
        $all_projects = Project::leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->select('projects.*', 'business_units.department_name', 'project_status.current_quality as current_status','project_status.updated_at as project_status_updated_at', 'project_status.cost_situation as cost_status', 'project_status.time_planning as time_status','project_status.current_quality_explanation as current_quality_explanation','project_status.cost_situation_explanation as cost_situation_explanation','project_status.time_planning_explanation as time_planning_explanation')
           ->where('projects.project_manager',\Auth::user()->id)
            ->orderBy($sortEntity, $sortOrder)->get();
        return view('backend.myproject.'.$view,compact('all_projects', 'sortOrder', 'sortEntity'));
    }

    public function viewProjectDeatils($id=null){
        $active_members=array();
        if(!empty($id) && $id!= null ){
            $project = Project::find($id);
            $project->businessName = BusinessUnit::where('id',$project->fk_businessUnitId)->pluck('department_name')->first();
            $projectManager = User::where('id',$project->project_manager)->pluck('name')->first();
            $members = User::get();
            $projectMembers = ProjectMember::where("fk_projectId",$id)->get();
            if(!empty($projectMembers)){
                foreach ($projectMembers as $key => $value) { $value->name = $value->fk_username; }
            }
            foreach($projectMembers as $member){ $active_members[] = $member->fk_userId; }
            
            $testTheFile = ProjectDocument::where('fk_projectId',$id)->get();
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
            $projectDocument = ProjectDocument::where('fk_projectId',$id)->get();
            return view('backend.myproject.project_detail',compact('project','members','projectMembers','projectDocument','projectManager','active_members'));
        }
    }

    public function updateProjectDetails(Request $request)
    {
        $validation = (new Project)->validateProjectDetails($request);
        if ($validation->fails()){
			$extra['message'] = __('sentence.project_detail_manage.details_not_saved');
            return webResponse(false, 206, $validation->getMessageBag(), $extra);
        }try{
            \DB::beginTransaction();
            $inputs = $request->input();
            if($request->hasFile('picture')){
                $image = $request->hasFile('picture');
                $folder = 'products/';
                $inputs['picture'] = imageUploadToStorage($request->file('picture'),$folder);
            }
            $response = (new Project)->updateProjectDetail($inputs);


			if(isset($inputs['hidden_public_documents'])){
				foreach($inputs['hidden_public_documents'] as $doc){
                    ProjectDocument::where(['fk_projectId'=>$request->input('id'),'document'=>$doc])->delete();
					ProjectDocument::create(array('fk_projectId'=>$request->input('id'), 'document'=>$doc, 'is_public'=>1));
				}
			}
			
			if(isset($inputs['hidden_internal_documents'])){
				foreach($inputs['hidden_internal_documents'] as $doc){
                   ProjectDocument::where(['fk_projectId'=>$request->input('id'),'document'=>$doc])->delete();
				   ProjectDocument::create(array('fk_projectId'=>$request->input('id'), 'document'=>$doc, 'is_public'=>0));
				}
			}

            \DB::commit();
        $extra['redirect'] = url('admin/project/detail/'.$request->input('id'));
           return webResponse(true, 200, __('sentence.project_detail_manage.details_successfully_saved'), $extra);

        }catch (\Exception $e){

            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'.$e));
        }
    }



    public function viewProjectDeatilsStatus($id=null){
        if(empty($id) || $id==null){
            return "404";
        }
        $project = Project::find($id);
        $project->fk_businessUnitId = BusinessUnit::where('id',$project->fk_businessUnitId)->pluck('department_name')->first();
        $project->project_manager = User::where('id',$project->project_manager)->pluck('name')->first();
        $projectsStatus = ProjectStatus::where("fk_projectId",$id)->first();
        if(empty($projectsStatus)){
            $projectsStatus = array();
        }
        return view('backend.myproject.project_status',compact('projectsStatus','project'));
    }


    public function updateProjectStatus(Request $request){
                
        $validation = (new ProjectStatus)->projectStatusValidation($request);

        if($validation->fails()){
			$extra['message'] = __('sentence.project_detail_manage.details_not_saved');
            return webResponse(false, 206, $validation->getMessageBag(), $extra);
        }try{
            \DB::beginTransaction();
            $inputs = $request->input();
            $previousStatus = ProjectStatus::where(['fk_projectId'=>$inputs['fk_projectId']])->first();
            //$inputs['real_start_date'] = Carbon::parse($inputs['real_start_date'])->format('Y-m-d');
            //$inputs['realistic_end_date'] = Carbon::parse($inputs['realistic_end_date'])->format('Y-m-d');
			if(isset($inputs['real_start_date'])){ 
				$inputs['real_start_date'] = Carbon::createFromFormat('d/m/y', $inputs['real_start_date'])->format('Y-m-d');
			}
			if(isset($inputs['realistic_end_date'])){
					$inputs['realistic_end_date'] = Carbon::createFromFormat('d/m/y', $inputs['realistic_end_date'])->format('Y-m-d');
			} 
			
            $project =  ProjectStatus::updateOrCreate(['fk_projectId'=>$inputs['fk_projectId']], $inputs);

            if($inputs['current_quality'] < $previousStatus['current_quality'] || $inputs['cost_situation'] < $previousStatus['cost_situation'] || $inputs['time_planning'] < $previousStatus['time_planning']){
               $projectDetail = Project::find($inputs['fk_projectId']);
                (new Project)->sendProjectHealthMail($projectDetail);
            }
			
			

            \DB::commit();
			
			
			$extra['redirect'] = url('admin/project/status/'.$inputs['fk_projectId']);
           return webResponse(true, 200, __('sentence.project_detail_manage.status_successfully_saved'), $extra);

        }catch (\Exception $e){

            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'). $e);
        }

    }



    public function removeDocument(Request $request){

        $active_members = array();
        if($request->table == 'document'){
            $document =  ProjectDocument::where(['id'=>$request->id])->pluck('document')->first();
            $data =  ProjectDocument::where(['id'=>$request->id])->delete();
                
            if(\File::exists(Storage::path('images/documents/').$document) && !empty($document) ){
                    \File::delete(Storage::path('images/documents/').$document);
                }

        }elseif($request->table == 'member'){
              $data =  ProjectMember::where(['id'=>$request->id,'fk_projectId'=>$request->project_id])->delete();
            
            $projectMembers = ProjectMember::where(["fk_projectId"=>$request->project_id])->get();
            

            return view('backend.myproject.doc_members',compact('projectMembers'));

        } 
        return webResponse(true, 200, 'Deleted.');

    }

    public function getActiveProjectMembers(){

    }

    public function getDownload($id=null){
        $document =  ProjectDocument::where(['id'=>$id])->pluck('document')->first();
        $exists = Storage::disk('loapp')->exists($document);
        if($exists){
            if(!empty($document)){
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

    public function addToMembers(Request $request){

        if(!empty($request->memberName) && !empty($request->project_id) ){

            $data =  ProjectMember::where(["fk_username"=>$request->memberName,'fk_projectId'=>$request->project_id])->first();

            if($data==null || empty($data)){

                $res = ProjectMember::create(['fk_projectId'=>$request->project_id,"fk_username"=>$request->memberName]);
            }
        }
        $projectMembers = ProjectMember::where(["fk_projectId"=>$request->project_id])->get();
        foreach($projectMembers as $member){ $active_members[] = $member->fk_userId; }
        return view('backend.myproject.doc_members',compact('projectMembers','active_members'));
    }
	
    public function uploadDocuments(Request $request)
    {

        $docNameArray = [];
        if ($request->hasFile('documents')) {
            foreach($request->file('documents') as $document) {
                $folder = 'documents/';
                $doc = imageUploadToStorage($document, $folder);
                $docNameArray[] = $doc;
            }
        }
        return $docNameArray;
    }

    public function aboutProjectAdmin($id=null){
        $locate = "";
        $isFrontEndValid='';
        if(Auth::user()){
            $isFrontEndValid = validateFullFrontEndView(Auth::user()->role,"front_end_view_panel");
        }
        $projectDetail = Project::where('id',$id)->first();
        $projectDetail->status = ProjectStatus::where('fk_projectId',$projectDetail->id)->first();
        $projectDetail->project_manager = User::where('id',$projectDetail->project_manager)->first(['name','avatar']);
        $projectDetail->members = ProjectMember::where(['fk_projectId'=>$projectDetail->id])->get();
        if(!empty($projectDetail->members)){
             foreach ($projectDetail->members as $key => $value) {
                $value->name = $value->fk_username;;
             }
        }
        $locate = $projectDetail->project_title;

        if(!empty($projectDetail->members)){
            $allMembers = '';
            $members= array();
            foreach ($projectDetail->members as $key => $value) {
                $members[] = ucfirst($value->name);
            }
            
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
        return view('backend.myproject.project_detail_view',compact('projectDetail','isFrontEndValid','locate','members','allMembers'));
    }

} 
