<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostingPlan;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class HostingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HostingPlan::latest()->get();
            return DataTables::of($data)
                    ->editColumn('per', function ($data) {
                        return $data->per==1 ? 'Month' :'Year';
                    })
                    ->addColumn('action', function($data){
                        $edit = route('admin.hostings.edit',$data->id);
                        $delete = route('admin.hostings.destroy',$data->id);
                        $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.hostings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hostings.addoredit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required|unique:hosting_plans,title',
            'price' => 'required|numeric',
            // 'per' => 'required',
            'website' => 'required',
            'storage' => 'required',
            'bandwidth' => 'required',
            'ram' => 'required',
            'db' => 'required',
            'emails' => 'required',
            'support' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{
            $data = $request->except(['_token']);
            $plan = HostingPlan::insert($data);
            if($plan){
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
        $plan = HostingPlan::find($id);
        return view('admin.hostings.addoredit',compact('plan'));
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'price' => 'required|unique:hosting_plans,title,'.$id,
            'per' => 'required',
            'website' => 'required',
            'storage' => 'required',
            'bandwidth' => 'required',
            'ram' => 'required',
            'db' => 'required',
            'emails' => 'required',
            'support' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $data = $request->except(['_token','_method']);
            $plan = HostingPlan::where('id', $id)->update($data);
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
        $plan = HostingPlan::find($id);
        if($plan->delete()){
            return true;
        }else{
            return false;

        }
    }
}
