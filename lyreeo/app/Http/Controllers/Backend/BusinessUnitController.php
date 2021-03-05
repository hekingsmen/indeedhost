<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use Validator;
use DB;

class BusinessUnitController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = (new BusinessUnit)->sortOrder;
        $sortEntity = (new BusinessUnit)->sortEntity;

        $result = null;
        if(isset($request->sortEntity) and isset($request->sortOrder))
        {
            $sortEntity = $request->sortEntity;
            $sortOrder = $request->sortOrder;
            $businessUnits = BusinessUnit::orderBy($sortEntity, $sortOrder)->get();
            return view('backend.business_units.pagination',compact('businessUnits', 'sortOrder', 'sortEntity'));
        }

        $businessUnits = BusinessUnit::orderBy($sortEntity, $sortOrder)->get();
        return view('backend.business_units.index',compact('businessUnits', 'sortOrder', 'sortEntity'));
    }

    public function saveDetails(Request $request)
    { 
        $rules = [
            'department_name'=>'required'
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails())
        {
            return webResponse(false, 206, $validation->getMessageBag());
        }
        try
        {
            \DB::beginTransaction();
            $inputs = $request->input();
             $businessUnit = BusinessUnit::where('department_name', $inputs['department_name'])->where('id', '<>',$inputs['id'])->first();
            if($businessUnit != null){
                return webResponse(false, 207,  __('sentence.bu_unit.already_exists'));
            }
            if(!empty($request->file('picture'))){
                $picture = uploadImage($request->file('picture'),"businessUnit");
                $inputs['picture'] = $picture;
            }
            
            BusinessUnit::updateOrCreate(['id'=>$inputs['id']], $inputs);
            \DB::commit();
            return webResponse(true, 200, __('sentence.bu_unit.successfully_saved'));
        } catch (\Exception $e)
        {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'));
        }
    }

    public function deleteBusinessUnit(Request $request)
    {
        $id = $request->id;
        BusinessUnit::where('id', $id)->delete();
         return webResponse(true, 200, __('sentence.bu_unit.deleted'));
    }
    
    public function toggleBusinessStatus(Request $request)
    {
        $departmentId = $request->id;

        $result = BusinessUnit::where('id', $departmentId)->first();
        if(!$result) {
            $message = 'Invalid Business Unit';
            return webResponse(false, 207, $message);
        }
        try
        {
            \DB::beginTransaction();
            $buData = ['is_hidden' => (bool) !$result->is_hidden];

            $result->update($buData);
            \DB::commit();
            $message = "Status Updated";
            return webResponse(true, 200, $message);
        } catch (\Exception $e)
        {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'));
        }
    }


}
