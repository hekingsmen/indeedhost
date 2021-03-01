<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\User;
use File;

use App\Models\Feature;

class FeatureController extends Controller

{

	public function index(Request $request){
    	
        if ($request->ajax()) {

            $data = Feature::latest()->get();

            	return DataTables::of($data)->addColumn('action', function($data){

                    $edit = route('admin.feature.edit',$data->id);
                    $delete = route('admin.feature.delete',$data->id);
                    $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';

                    return $button;

                })->rawColumns(['action'])->make(true);

        }

        return view('admin.feature.index');

    }


    public function create(){

        return view('admin.feature.addoredit');
    }



    public function store(Request $request){

    	$validation = (new Feature)->validateSliderDetails($request);

        if($validation->fails()) {

         	return back()->withErrors($validation);
        }
        try
        {

            \DB::beginTransaction();
                


	            $imageName = (new Feature)->saveFeatureImage($request->File('image'));

	            (new Feature)->saveFeatureDetails($request,$imageName);

            \DB::commit();

            return back()->with('success','Added successfully');


        }
        catch (\Exception $e)
        {
            \DB::rollBack();
            return back()->with('error','Something Wrong');
        }	

    }



    public function edit($id=null){   

        $route = Feature::find($id);

        return view('admin.feature.addoredit',compact('route'));

    }




    public function update(Request $request, $id=null){

    	$validation = (new Feature)->validateFeatureUpdateDetails($request);

        if($validation->fails()) {

         	return back()->withErrors($validation);
        }
        try
        {
            \DB::beginTransaction();

            if($request->hasFile('image')){
            	$imageName = (new Feature)->saveFeatureImage($request->File('image'));
            }else{
            	$imageName = null;
            }

            (new Feature)->updateFeature($request,$id,$imageName);

            \DB::commit();

            return back()->with('success','Updated successfully');


        }
        catch (\Exception $e)
        {
            \DB::rollBack();
            return back()->with('error','Something Wrong');
        }


    }



    public function destroy($id=null){
        
        $response = Feature::where('id',$id)->delete();
            
            if($response){

                return true;
            }else{

                return false;
            }
    }

}

?>