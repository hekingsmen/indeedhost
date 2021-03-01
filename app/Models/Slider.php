<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

class Slider extends Model
{
    
    protected $fillable = ["user_id", "image", "heading_first",'heading_second','text'];
    protected $table = "sliders";
    protected $primaryKey = "id";


    public function saveSliderDetails($inputs=null,$imageName=null){

    	$data = $inputs->except(['_token']);

    	$data['user_id'] = Auth::user()->id;
    	$data['image'] = $imageName;

    	Slider::Create($data);
    }

    
    function saveSliderImage($image=null){
    	
    	$random_number = mt_rand(1000, 9999);
	    $imgName = str_replace(' ', '', $random_number."_".$image->getClientOriginalName());

    	Storage::disk('topublic')->put($imgName, file_get_contents($image->getRealPath()));

    	return $imgName;
	}	


    public function validateSliderDetails($request){

        return $validator = Validator::make($request->all(), [

            'heading_first'=>'required|string',
            'heading_second'=>'required|string',
            'text'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    }

    public function validateSliderUpdateDetails($request){

        return $validator = Validator::make($request->all(), [

            'heading_first'=>'required|string',
            'heading_second'=>'required|string',
            'text'=>'required|string',
            // 'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    }

    public function updateSlider($inputs=null,$id=null,$imageName=null){

    	if($imageName!=null){
    		$imageName = $imageName;
    	}else{
    		$imageName = Slider::where('id',$id)->pluck('image')->first();
    	}

    	$data = $inputs->except(['_token','_method']);

    	$data['user_id'] = Auth::user()->id;
    	$data['image']   = $imageName;

    	Slider::where('id', $id)->update($data);
    }

}
