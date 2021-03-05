<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\User;
use Illuminate\Support\Str;
use Storage;

class HomepageController extends Controller
{
    public function index(){
    	$department = BusinessUnit::where('is_hidden',0)->get();
        if(!empty($department)){
            foreach ($department as $key => $value) {
                $value->project_count = Project::where(['fk_businessUnitId'=>$value->id,'is_active'=>1])->count();
            }
        }
    	return view('backend.homepage_admin',compact('department'));
    }

    public function uploadImage(Request $request)
    {
        try{
            \DB::beginTransaction();

                $inputs = $request->input();
                $image = $inputs['picture'];  // your base64 encoded
            $extra = [];
			    if($inputs['picture'] != '') {
					$image = str_replace('data:image/png;base64,', '', $image);
					$image = str_replace(' ', '+', $image);
					$imageName = Str::random(10).'.'.'png';
				
				} else{
					$imageName = '';
					 $folder = "";
				}
                
               
                if($inputs['type'] == 'profile_picture') {
                    $folder = "avatar/";
					$pictureToInsert = '';
					if($inputs['picture'] != '') {
						$pictureToInsert =  $folder.$imageName;
					}
                    User::where('id', $inputs['id'])->update(['avatar'=>$pictureToInsert]);
                    $extra['redirect'] = url('admin/profile');
                } else if($inputs['type'] == 'business_unit'){
                    $folder = "businessUnit/";
                    if($inputs['id'] != 0){ 
					    $pictureToInsert = '';
						if($inputs['picture'] != '') {
						    $pictureToInsert =  $folder.$imageName;
						}
                        BusinessUnit::where('id', $inputs['id'])->update(['picture'=>$pictureToInsert]);
                    }
                }else if($inputs['type'] == 'project'){
                    $folder = "project";
                    if($inputs['id'] != 0) {
						$pictureToInsert = '';
						if($inputs['picture'] != '') {
							$pictureToInsert =  $folder.$imageName;
							 
						}
                        Project::where('id', $inputs['id'])->update(['picture' => $pictureToInsert]);
						$extra['redirect'] = url('admin/project/edit/'.$inputs['id']);
                    }
                }
				if($inputs['picture'] != '') {
							$pictureToInsert =  $folder.$imageName;
							 
						}
            if($inputs['id'] == 0 || $inputs['type'] == 'project') {
                $extra['picture'] = $pictureToInsert;
            }
            if($inputs['picture'] != '') {
				file_put_contents('image/'.$pictureToInsert, base64_decode($image));
			}
            \DB::commit();

            return webResponse(true, 200, 'Picture saved.',$extra);
        } catch (\Exception $e) {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error').$e);
        }

    }

}
 