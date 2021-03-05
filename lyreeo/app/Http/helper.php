<?php
use App\User;

function webResponse($success, $code, $reply, $extra = []){
    $response = [
        'status' => $code,
        'success' => $success,
        'message' => '',
        'errors' => [],
        'result' => [],
        'extra' => $extra ? $extra : new ArrayObject(),
    ];

    if ($code == 201) {
        $response['result'] = $reply;
    } elseif ($code == 406 ||  $code == 206 ) {
        $response['errors'] = webErrors($reply);
    } else {
        $response['message'] = $reply;
    }
    return response()->json($response);
}

function webErrors($errors = [])
{
    $error = [];
    if(!is_array($errors)){
        $errors = $errors->toArray();
    }

    foreach ($errors as $key => $value)
    {
        $error[$key] = $value[0];
    }
    return $error;
}

function uploadImage($image, $folder) {

    $random_number = mt_rand(1000, 9999);
    $imgName = str_replace(' ', '', $random_number."_".$image->getClientOriginalName());
    $image->hashName($imgName);
    
    $storagePath = Storage::disk('local')->put('images/'.$folder, $image);
    $storageName = basename($storagePath);

    return $storageName;
}



function imageUploadToStorage($image, $folder){
    $random_number = mt_rand(1000, 9999);
    // $imgName = str_replace(' ', '', $random_number."_".$image->getClientOriginalName());
    $imgName = $image->getClientOriginalName();
    Storage::disk('loapp') -> put($imgName, file_get_contents($image -> getRealPath()));
    return $imgName;
}



function sendMail($tmeplateID=null,$emailAddress=null){

    $data = ['id' => $tmeplateID, 'mail' =>  $emailAddress ];
    $res  = Mail::to('technodeviser05@gmail.com')->send(new App\Mail\Mailer($data));
    return $res;
}

function getStatusColor(){
    $data = array(
        'Green'=> __('sentence.good'),
        'Yellow'=>__('sentence.average'),
        'Red'=>__('sentence.bad'),
    );
    return $data;
}

function getStatusColors(){
    $data = array(
        '3'=>__('sentence.good'),
        '2'=>__('sentence.average'),
        '1'=>__('sentence.bad'),
    );
    return $data;
}

function sorting($name, $sortEntity, $sortOrder)
{
    return '<p>'.$name .'</p><span class="sorting">
                     <a style="color: #000 !important;" href="javascript:void(0);" data-sortEntity="' . $sortEntity . '" data-sortOrder="asc">
                     <img src="'.url("dist/images/up-arrow.png").'"> </a>
                     <a style="color: #000 !important;" href="javascript:void(0);" data-sortEntity="' . $sortEntity . '" data-sortOrder="desc">
                     <img src="'.url("dist/images/down-arrow.png").'"> </a>
                 <span>';
}

function validateFullFrontEndView($roleID=null,$module=null){
    $response = DB::table('roles')->where('id',$roleID)->pluck($module)->first();
    return $response;
}

function projectStar($status=null){
    $img='';
    if(!empty($status) && $status!=null){
        if($status=="1"){
            $img = "dist/images/star/red-star.png";
        }elseif($status=="2"){
            $img = "dist/images/star/yellow-star.png";
        }elseif($status=="3"){
            $img = "dist/images/star/green-star.png";
        }
    }
    return $img;
}

function projectTime($status=null){
    $img='';
    if(!empty($status) && $status!=null){
        if($status=="1"){
            $img = "dist/images/clock/red-clock.png";
        }elseif($status=="2"){
            $img = "dist/images/clock/yellow-clock.png";
        }elseif($status=="3"){
            $img = "dist/images/clock/green-clock.png";
        }
    }
    return $img;
}

function projectCost($status=null){
    $img='';
    if(!empty($status) && $status!=null){
        if($status=="1"){
            $img = "dist/images/coin/red-coin.png";
        }elseif($status=="2"){
            $img = "dist/images/coin/yellow-coin.png";
        }elseif($status=="3"){
            $img = "dist/images/coin/green-coin.png";
        }
    }
    return $img;
}

function dynamicToggleHeading(){
    $routeName = \Request::route()->getName(); 
    switch ($routeName) {
        case "businessUnits":
            $title =  "BU Management";
            break;
        case "userRoles":
            $title =  "Role Management";
            break;
        case "allUsers":
            $title =  "User Management";
            break;
        case "allProjects":
            $title =  "Active Projects";
            break;
        case "myProjectsList":
            $title =  "Project Management";
            break;
        case "updateStatus":
            $title =  "Latest Status Updates";
            break;
        case "profile":
            $title =  "My Profile";
            break; 
		case "template_list":
            $title =  "Email Template";
            break;
        default:
            $title =  "Management";
    }
    return $title;
}

function languageCollector(){
    $data = array(
        'en'=>"EN",
        'de'=>"DE",
        'fr'=>"FR",
    );
    return $data;
}

function getCurrentRouteName(){
    $routeName = \Request::route()->getName();
    return $routeName;
}

function dynamicBreadcrumb(){
    $routeName = \Request::route()->getName();
    switch ($routeName) {
        case "businessUnits":
            $title =   __('sentence.business_unit_breadcrumb');
            break;
        case "userRoles":
            $title =   __('sentence.roles_breadcrumb');
            break;
        case "allUsers":
            $title =   __('sentence.users_breadcrumb');
            break;
        case "archive_project":
            $title =   __('sentence.archive_project_breadcrumb');
            break;
        case "doneButActive":
            $title =   __('sentence.done_but_active_breadcrumb');
            break;
        case "allProjects":
            $title =  "Projects";
			 $title =   __('sentence.projects_breadcrumb');
            break;
        case "myProjectsList":
            $title =   __('sentence.my_projects_breadcrumb');
            break;
        case "projectStatus":
           $title =   __('sentence.status_update_breadcrumb');
            break;
        case "profile":
        	$title =   __('sentence.my_profile_breadcrumb');
            break;
        case "viewProjectDeatils":
          $title =   __('sentence.modify_project_breadcrumb');
            break;
        case "viewProjectDeatilsStatus":
	       $title =   __('sentence.update_status_breadcrumb');
            break;
	    case "template_list":
            $title =  __('sentence.email_temp_breadcrumb');;
            break;
        case "401": $title =  "Unauthorized Access";
            break;
        default:
           $title =   __('sentence.modify_project_breadcrumb');
    }

    return $title;
}

function pId(){
    return request()->id;
}

function breadcrumbFrontend($businessUnitsId=null){
    $businessUnitsName = DB::table('business_units')->where('id',$businessUnitsId)->first(['department_name']);
	if($businessUnitsName == null){
		return '';
	}
    return $businessUnitsName->department_name ;
}

function dynamicFrontendTitle(){
    $routeName = \Request::route()->getName();
    switch ($routeName) {
        case "allProjectsViews":
            $title =  "Lyreco - All Projects";
            break;
        case "homepage":
            $title =  "Lyreco - Homepage";
            break;
        default:
            $title = null;
    }

    return $title;
}

function dynamicBackendTitle(){
    $routeName = \Request::route()->getName();
    switch ($routeName) {
        case "businessUnits": $title =  "Lyreco - Business Unit";
            break;
        case "userRoles": $title =  "Lyreco - Roles";
            break;
        case "allUsers": $title =  "Lyreco - Users";
            break;
        case "allProjects": $title =  "Lyreco - Projects";
            break;
        case "myProjectsList": $title =  "Lyreco - My Projects";
            break;
        case "projectStatus": $title =  "Lyreco - Status Updates";
            break;
        case "profile": $title =  "Lyreco - My Profile";
            break;
        case "viewProjectDeatils": $title =  "Lyreco - Modify Project";
            break;
        case "viewProjectDeatilsStatus": $title =  "Lyreco - Update Status";
            break;
        case "401": $title =  "Lyreco - Unauthorized Access";
            break;
        default:
            $title =  "Lyreco - Modify Project";
    }

    return $title;
}

function guestToken(){
	$user_detail = User::find(2);
	return $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user_detail);
}

function calculateGoLive($endDate){
    $today = \Carbon\Carbon::today();
    $endDate = \Carbon\Carbon::parse($endDate);
    return $diff =  $today->diffInDays($endDate,false);
}


function excelYesNo($number){
    if($number == 1){
       return __('sentence.excel.yes');
    } else{
        return __('sentence.excel.no');
    }
}

function excelGetStatusColors($color){
   if($color == 3){
       return __('sentence.excel.good');
   } else if($color == 2){
       return __('sentence.excel.average');
   } else if($color == 1){
       return __('sentence.excel.bad');
   } else{
       return "";
   }
}