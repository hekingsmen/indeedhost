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


class SliderController extends Controller

{

	  public function index(Request $request)

    {
    	// dd(Slider::latest()->get());
        if ($request->ajax()) {

            $data = Slider::latest()->get();

            	return DataTables::of($data)->addColumn('action', function($data){

                    $edit = route('admin.slider.edit',$data->id);
                    $delete = route('admin.slider.delete',$data->id);
                    $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';

                    return $button;

                })->rawColumns(['action'])->make(true);

        }

        return view('admin.sliders.index');

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('admin.sliders.addoredit');

    }





    public function store(Request $request)

    {

    	$validation = (new Slider)->validateSliderDetails($request);

        if($validation->fails()) {

         	return back()->withErrors($validation);
        }
        try
        {

            \DB::beginTransaction();
            
	            $imageName = (new Slider)->saveSliderImage($request->File('image'));

	            (new Slider)->saveSliderDetails($request,$imageName);

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

        $route = Slider::find($id);

        return view('admin.sliders.addoredit',compact('route'));

    }




    public function update(Request $request, $id=null){



    	$validation = (new Slider)->validateSliderUpdateDetails($request);

        if($validation->fails()) {

         	return back()->withErrors($validation);
        }
        try
        {
            \DB::beginTransaction();


            if($request->hasFile('image')){
            	$imageName = (new Slider)->saveSliderImage($request->File('image'));
            }else{
            	$imageName = null;
            }

            (new Slider)->updateSlider($request,$id,$imageName);

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

        $response = Slider::find($id);

        if($response->delete()){

            return true;

        }else{

            return false;

        }

    }

}

?>