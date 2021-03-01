<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Routesmanager;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class RoutesmanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Routesmanager::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $edit = route('admin.routesmanager.edit',$data->id);
                        $delete = route('admin.routesmanager.destroy',$data->id);
                        $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.routesmanager.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.routesmanager.addoredit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo"<pre>";print_r($request->all());die;
        $rules = array(
            'route_name' => 'required|unique:routesmanagers,route_name',
            //'route_slag' => 'required',
            'route_url' => 'required|unique:routesmanagers,route_url',
            'module_name' => 'required',
            'route_action' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }else{
            $data = $data = $request->except(['_token']);
            $user = Routesmanager::insert($data);
            if($user){
                return back()->with('success','Added successfully');
            }else{
                return back()->with('error','Something Wrong');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $route = Routesmanager::find($id);
        return view('admin.routesmanager.addoredit',compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'route_name' => 'required|unique:routesmanagers,route_name,'.$id,
            //'route_slag' => 'required',
            'route_url' => 'required|unique:routesmanagers,route_name,'.$id,
            'module_name' => 'required',
            'route_action' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
           return back()->withErrors($validator);
        } else {
            $data = $request->except(['_token','_method']);
            $plan = Routesmanager::where('id', $id)->update($data);
            if($plan){
            return back()->with('success','Successfully updated');
            }else{
                return back()->with('error','Something Wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // delete
        $plan = Routesmanager::find($id);
        if($plan->delete()){
            return true;
        }else{
            return false;

        }
    }
}
