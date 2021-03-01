<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

class Feature extends Model
{
    
    protected $fillable = ["user_id", "image", "title",'description'];
    protected $table = "features";
    protected $primaryKey = "id";


    public function saveFeatureDetails($inputs=null,$imageName=null){

    	$data = $inputs->except(['_token']);

    	$data['user_id'] = Auth::user()->id;
    	$data['image'] = $imageName;

    	Feature::Create($data);
    }

    
    function saveFeatureImage($image=null){


    	$random_number = mt_rand(1000, 9999);
	    $imgName = str_replace(' ', '', $random_number."_".$image->getClientOriginalName());

    	Storage::disk('forfeatures')->put($imgName, file_get_contents($image->getRealPath()));

    	return $imgName;
	}	


    public function validateSliderDetails($request){

        return $validator = Validator::make($request->all(), [

            'title'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    }

    public function validateFeatureUpdateDetails($request){

        return $validator = Validator::make($request->all(), [

            'title'=>'required|string',
            'description'=>'required|string',
        ]);

    }

    public function updateFeature($inputs=null,$id=null,$imageName=null){

    	if($imageName!=null){
    		$imageName = $imageName;
    	}else{
    		$imageName = Feature::where('id',$id)->pluck('image')->first();
    	}

    	$data = $inputs->except(['_token','_method']);

    	$data['user_id'] = Auth::user()->id;
    	$data['image']   = $imageName;

    	Feature::where('id', $id)->update($data);
    }

}
