<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offer;
use App\Models\HostingPlan;
use File;
use Response;

use App\Models\Feature;

class OffersController extends Controller
{

    public function __construct(){

        //$this->middleware('auth');
    }

    public function index(Request $request){

        if ($request->ajax()) {

            $data = Offer::latest()->get();

            return DataTables::of($data)->addColumn('action', function($data){

                $edit = route('admin.offers.edit',$data->id);
                $delete = route('admin.offers.delete',$data->id);
                $button = '<a name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$edit.'">Edit</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$data->id.'" data-url="'.$delete.'">Delete</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }

        return view('admin.offers.index');

    }

    public function create(){

        $plans = HostingPlan::all();
        $specific_item = array();
        $restricted_item  = array();
        return view('admin.offers.addoredit',compact('plans','specific_item','restricted_item'));
    }


    public function save(Request $request){

        $validation = (new Offer)->validateOfferDetails($request);

        if($validation->fails()) {
            return back()->withErrors($validation);
        }

        try{
            \DB::beginTransaction();
                (new Offer)->saveOfferDetails($request->except(['_token']));
            \DB::commit();

            return back()->with('success','Offer successfully Created');

        }catch (\Exception $e){

            \DB::rollBack();
            return back()->with('error','Something Wrong');
        }

    }

    public function edit($id=null){

        $plans = HostingPlan::all();
        $route = Offer::find($id);
        $type  = $route->type;
        $specific_item =  json_decode($route->specific_item);
        $restricted_item =json_decode($route->restricted_item);

        return view('admin.offers.addoredit',compact('route','plans','specific_item','restricted_item','type'));
    }

    public function update(Request $request){

        $validation = (new Offer)->validateOfferDetails($request);

        if($validation->fails()) {
            return back()->withErrors($validation);
        }
        try{

            \DB::beginTransaction();
            $response = (new Offer)->checkValidOfferCode($request->except(['_token']));
            if($response == false){
                (new Offer)->saveOfferDetails($request->except(['_token']));
                return back()->with('success','Offer successfully Created');
            }else{
                return back()->with('error','Entered Offer code already Registered');
            }

            \DB::commit();

        }catch (\Exception $e){

            \DB::rollBack();
            return back()->with('error','Something Wrong');
        }
    }



    public function destroy($id=null){

        $response = Offer::find($id);
        if($response->delete()){
            return true;
        }else{
            return false;
        }

    }



    public function checkValidOfferCode(Request $request){

        $ifAny = Offer::where('code',$request['code'])->get();
        if(count($ifAny)>0){
            $msg = "Chosen Offer code is already rgistered.";
            $success = false;
        }else{
            $msg = "Chosen Offer code is available.";
            $success = true;
        }
        return Response::json(array(
            'success' => $success,
            'msg'    => $msg
        ));
    }


}
?>