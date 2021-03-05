<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\HostingPlan;
use App\Models\OrderItems;
use App\Mail\Reminder;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Mail;
use DB;

class UsersprofileController extends Controller

{

    public function __construct(){

        $this->middleware('auth');
    }


    public function Viewprofile (Request $request){

        $user = auth()->user();

        if($request->isMethod('post')){

        $rules = array(

            'name' => 'required|string',
            'phone_number' => 'nullable|numeric',
            'primary_number' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return back()->withInput()->withErrors($validator);

            }else{
                
                $data = $request->except(['_token','user_id']);
                $ussr = User::find($user->id);
                $ussr->update($data);
                return back()->with('success','Successfully update');
            }

        }else{

//            return view('userprofile',compact('user'));
            return view('user.userprofile',compact('user'));

        }
    }


    public function userOrder(Request $request){

        $user = auth()->user();
        $orders = OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')
            ->where('orders.user_id','=', $user->id)->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('user.userorders',compact('orders'));

    }

    public function userOrder_old (Request $request){

        //$user = auth()->user();
        // $orders = DB::table('orders')
        //  ->join('order_items', function ($join) {
        //  $join->on('orders.id', '=', 'order_items.order_id')
        //  ->select('order_items.*','orders.payment_status');
        //  })->get();
        $user = auth()->user();
        // $orders= Order::leftJoin('order_items', 'order_items.order_id',  '=', 'orders.id')->select('order_items.*','orders.payment_status' ,'order_items.taxrate as taxrate','order_items.discountRate as discountRate')->where('orders.user_id','=', $user->id)->get();
        $orders = OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->where('orders.user_id','=', $user->id)->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email')->orderBy('id', 'DESC')->paginate(10);
//        return view('userorders',compact('orders'));
        return view('user.userorders',compact('orders'));

    }

}

