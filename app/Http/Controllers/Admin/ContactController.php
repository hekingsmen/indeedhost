<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\ContactDetail;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Slider;
use App\Models\User;
use File;
use Auth;


class ContactController extends Controller

{

    public function index(Request $request){

        if ($request->ajax()) {

            $data = ContactUs::latest()->get();

            return DataTables::of($data)->addColumn('action', function($data){

//                $edit = route('admin.slider.edit',$data->id);
                $delete = route('admin.contact.delete',$data->id);
//                $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                $button = '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';

                return $button;

            })->rawColumns(['action'])->make(true);

        }
        return view('admin.contact.index');
    }

    public function destroy($id=null){
        $response = ContactUs::find($id);
        if($response->delete()){
            return true;
        }else{
            return false;
        }
    }

    public function getAdminId(){
        return User::where('is_admin',1)->pluck('id')->first();
    }

    public function ContactPageDetail(){

        $data = ContactDetail::where('user_id',$this->getAdminId())->first();
        return view('admin.contact.addoredit',compact('data'));
    }

    public function saveContactPageDetail(Request $request){
        $rules = array(
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'website' => 'required|string',
            'address' => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $data = [
                'phone' => $request->phone,
                'email' => $request->email,
                'website' => $request->website,
                'address' => $request->address,
            ];

            ContactDetail::updateOrCreate( [ 'id' => $request->id ],$data);

//            $res = ContactDetail::where('id',$request->id)->update($data);

            return back()->with('success','Contact detail has been successfully updated');
        }
    }




}
?>