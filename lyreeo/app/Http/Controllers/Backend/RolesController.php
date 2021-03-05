<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Validator;
use App\User;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = (new Role)->sortOrder;
        $sortEntity = (new Role)->sortEntity;

        $view = 'index';
        if(isset($request->sortEntity) and isset($request->sortOrder)) {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $view = 'pagination';
        }

        $roles = Role::where('is_active', 1)->orderBy($sortEntity, $sortOrder)->get();
        return view('backend.roles.'.$view,compact('roles', 'sortOrder', 'sortEntity'));
    }

    public function saveRoleDetail(Request $request)
    {
        $input = $request->input();
        $id = $input['id'];
        $rules = [
            'name'=>'required|string',
            //'name'=>'required|string|unique:roles,name,'.$id,
            'admin_panel'=>'nullable',
            'project_management_panel'=>'nullable',
            'reporting_panel'=>'nullable',
            'front_end_view_panel'=>'nullable',
            'alerts'=>'nullable',
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()){
            return webResponse(false, 206, $validation->getMessageBag());
        }else{
            if(isset($input['admin_panel'])) {
                $input['admin_panel'] = 1;
            } else{
                $input['admin_panel'] = 0;
            }

            if(isset($input['project_management_panel'])) {
                $input['project_management_panel'] = 1;
            } else{
                $input['project_management_panel'] = 0;
            }

            if(isset($input['reporting_panel'])) {
                $input['reporting_panel'] = 1;
            } else{
                $input['reporting_panel'] = 0;
            }

            if(isset($input['front_end_view_panel'])) {
                $input['front_end_view_panel'] = 1;
            } else{
                $input['front_end_view_panel'] = 0;
            }

            if(isset($input['alerts'])) {
                $input['alerts'] = 1;
            } else{
                $input['alerts'] = 0;
            }

            Role::updateOrCreate(['id'=>$input['id']], $input);
            return webResponse(true, 200, __('sentence.role_manage.successfully_saved'));
        }
    }

    public function deleteRole($id)
    {
        $result = Role::where('id', $id)->pluck('name')->first();
        if(strtolower($result) == "super admin" || strtolower($result) == "guest"){
            return false;
        }else{
            $usersWithRoleExist = User::where('role', $id)->first();
            if($usersWithRoleExist == null){
                $a= Role::where('id', $id)->delete();
            } else{
                Role::where('id', $id)->update(['is_active'=>0]);
            }

            return webResponse(true, 200, __('sentence.role_manage.deleted'));
        }
    }


}
