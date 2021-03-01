<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\ProcessEmail;
use App\Models\User;
use Carbon\Carbon;
use DB;
use App\Models\HostingPlan;

class HostingMonitorController extends Controller

{

	public function listHostingsABoutToExpire_old(){
		$data =   OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email','orders.order_id as payment_id')->where('orders.payment_status','paid')->orderBy('id', 'DESC')->get();

	        if(!empty($data)){
		        foreach ($data as $key => $plan) {
	            	$plan->activation_date = date('d-M-y', strtotime( str_replace('/', '-', $plan->created_at)));
	        		$plan->expire_date = date('d-M-y', strtotime( str_replace('/', '-', $plan->expired_at)));

		        	$plan->user_id       =   User::where('id',$plan->user_id)->first();
		        	$activation_date     =   Carbon::parse($plan->created_at);
	            	$deactivation_date   =   Carbon::parse($plan->expired_at);
	            	
	            	if($deactivation_date > Carbon::now()){
	            		$plan->leftDays      =   $deactivation_date->diffInDays(Carbon::now());
	            	}else{
	            		unset($data[$key]);
	            	}
		        }
	        }
	        dd($data);
	}

	public function listHostingsABoutToExpire($type ='all',Request $request){
        
	    
        if ($request->ajax()) {
        	$data =   OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email','orders.order_id as payment_id')->where('orders.payment_status','paid')->orderBy('id', 'DESC')->get();

	        if(!empty($data)){
		        foreach ($data as $key => $plan) {
	            	$plan->activation_date = date('d-M-y', strtotime( str_replace('/', '-', $plan->created_at)));
	        		$plan->expire_date = date('d-M-y', strtotime( str_replace('/', '-', $plan->expired_at)));

		        	$plan->user_id       =   User::where('id',$plan->user_id)->first();
		        	$activation_date     =   Carbon::parse($plan->created_at);
	            	$deactivation_date   =   Carbon::parse($plan->expired_at);
	            	$plan->leftDays      =   $deactivation_date->diffInDays(Carbon::now());
	            	

					if($deactivation_date > Carbon::now()){
	            		$plan->leftDays      =   $deactivation_date->diffInDays(Carbon::now());
	            		if($plan->leftDays >= 30){
	            			unset($data[$key]);
	            		}	
	            	}else{
	            		unset($data[$key]);
	            	}
		        }
	        }
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $orderview = url('admin/hosting/overview',$data->id);
                        $delete = route('admin.hostings.destroy',$data->id);
                        $button = '<a name="view" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$orderview.'">View</a>';
                        return $button;

                    })->rawColumns(['action'])->make(true);
        }

        return view('admin.hostings_about_to_expire.index', compact('type'));
    }



    public function todaysSale($type ='all',Request $request){
    	
	    if ($request->ajax()) {
	    	$date = date("Y-m-d");
	        $data =   OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email','orders.order_id as payment_id')->whereDate('order_items.created_at',$date)->orderBy('id', 'DESC')->get();
	        foreach ($data as $key => $value) {
	        	$value->activation_date = date('d-M-y', strtotime( str_replace('/', '-', $value->created_at)));
	        	$value->expire_date = date('d-M-y', strtotime( str_replace('/', '-', $value->expired_at)));
	        }
	            return DataTables::of($data)
	                    ->addColumn('action', function($data){
	                        $orderview = url('admin/sale/overview',$data->id);
	                        $delete = route('admin.hostings.destroy',$data->id);
	                        $button = '<a name="view" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$orderview.'">View</a>';
	                        return $button;

	                    })->rawColumns(['action'])->make(true);
	    }

        return view('admin.hostings_about_to_expire.todaysSale', compact('type'));
    }

    public function saleOverview(Request $request){
    	$item =   OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email','orders.order_id as payment_id')->orderBy('id', 'DESC')->first();
    	$item->user_id       =   User::where('id',$item->user_id)->first();

    	return view('admin.hostings_about_to_expire.orderview', compact('item'));

    }

}

