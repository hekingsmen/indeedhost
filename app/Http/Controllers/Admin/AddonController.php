<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Addons;
use App\Features;
use App\User;
use App\AddonFeatures;
use App\UserPermissions;
use Auth;
use Session;
use DB;

class AddonController extends Controller
{
 	
 	public function tables(){
 		foreach (DB::select('SHOW TABLES') as $tables) {
            foreach ($tables as $table => $value)
                $table_list[] = $value;
        }
        return $table_list;
 	}

	public function index(Request $request){
		if ($request->ajax()) {
            $data = Addons::All();
            return DataTables::of($data)
                ->editColumn('per', function ($data) {
                	if(!empty($data->actions)){
						$arr = unserialize($value->actions);
						return implode(',',$arr);
					}else{
						return 'none';
					}
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
		
        return view('admin.addons.index');
	}

	public function create()
    {
    	$tables = $this->tables();
        return view('admin.addons.addoredit',compact('tables'));
    }

    public function store(Request $request){
    	//echo "<pre>";print_r($request->all());die;
        return back()->with('success','successfully added');
    }

}
