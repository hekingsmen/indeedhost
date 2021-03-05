<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\OrderItems;
use App\Mail\ProcessEmail;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use DB;

class OrdersController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($type ='all',Request $request){

        if ($request->ajax()) {
            if($type != 'all'){
                $data =  DB::table('orders')
                    ->join('order_items', function ($join) use($type) {
                    $join->on('orders.id', '=', 'order_items.order_id')
                    ->select('orders.*','order_items.status')
                     ->where('order_items.status', '=', $type);
                    })->get();
            }else{
                $data =   DB::table('orders')
                    ->join('order_items', function ($join) use($type) {
                    $join->on('orders.id', '=', 'order_items.order_id')
                    ->select('orders.*','order_items.status');
                    })->get();
            }

            return DataTables::of($data)
                    ->addColumn('action', function($data){

                        $orderview = route('admin.orderview',$data->id);
                        $delete = route('admin.hostings.destroy',$data->id);
                        $button = '<a name="view" id="'.$data->id.'" class="edit btn btn-primary btn-sm" href="'.$orderview.'">View</a>';

                        // if($data->status==='process'){
                        //     $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="test'.$data->id.'" class="btn btn-info btn-sm process" data-id="'.$data->id.'" data-email="'.$data->email.'" data-toggle="modal" data-target="#myModal">Process</button>';
                        // }else if($data->status ==='completed'){
                        //     $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warring btn-sm">Completed</button>';
                        // }else{
                        //     $button .= '&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm">Canceled</button>';
                        // }

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.orders.index', compact('type'));

    }


     public function create(){
         return view('admin.hostings.addoredit');
     }


    public function orderprocess(Request $request){

        $details = [
            'title' => 'You are cpanel credentials',
            'body' =>   $request->massage,
            'password' =>   $request->password,
            'username' =>   $request->username,
            'domain' =>   $request->domain,
        ];

        //$email = Mail::to($request->useremail)->send(new ProcessEmail($details));
        //$order = OrderItems::where('order_id', '=', $request->orderid)->first();
        $order = OrderItems::find($request->orderid);

//        old code
        if( $order->duration == 12 ){

            $exdate = Carbon::now()->addYear(1);

        }elseif( $order->duration == 24 ){

            $exdate = Carbon::now()->addYear(2);

        }elseif( $order->duration == 36 ){

            $exdate = Carbon::now()->addYear(3);
        }elseif( $order->duration == 1 ){
            $exdate = Carbon::now()->addMonth(1);
        }

//        if($order->duration == '2'){
//            $exdate = Carbon::now()->addYear(1);
//        }
//        if($order->duration == '1'){
//            $exdate = Carbon::now()->addMonth(1);
//        }

        $data = array(
            'status'=>'completed',
            'expired_at'=>$exdate,
            'password'=>$request->password,
            'username'=>$request->username,
            'domain'=>$request->domain,
        );

        $order->update($data);
        return back()->with('success','Email successfully sent');

    }



    public function orderview($id, Request $request){

//        $order = Order::find($id);
        $order = OrderItems::find($id);
        return view('admin.orders.orderview',compact('order'));

    }



    // public function store(Request $request){

    //     $rules = array(
    //         'title' => 'required',
    //         'price' => 'required',
    //         'per' => 'required',
    //         'website' => 'required',
    //         'storage' => 'required',
    //         'bandwidth' => 'required',
    //         'ram' => 'required',
    //         'db' => 'required',
    //         'emails' => 'required',
    //         'support' => 'required',
    //     );
    //     $validator = Validator::make($request->all(), $rules);


    //     // process the login
    //     if ($validator->fails()) {
    //         return back()->with('error','Something Wrong');
    //     }else{
    //         $data = $request->except(['_token']);
    //         $plan = HostingPlan::insert($data);
    //         if($plan){
    //             return back()->with('success','Added successfully');
    //         }else{
    //             return back()->with('error','Something Wrong');
    //         }
    //     }
    // }


    // public function show($id)
    // {
    //     //
    // }



    // public function edit($id)
    // {
    //     $plans = HostingPlan::find($id);
    //     return view('admin.hostings.addoredit',compact('plans'));
    // }


    // public function update(Request $request, $id){

    //     // validate
    //     // read more on validation at http://laravel.com/docs/validation
    //     $rules = array(
    //         'title' => 'required',
    //         'price' => 'required',
    //         'per' => 'required',
    //         'website' => 'required',
    //         'storage' => 'required',
    //         'bandwidth' => 'required',
    //         'ram' => 'required',
    //         'db' => 'required',
    //         'emails' => 'required',
    //         'support' => 'required',
    //     );
    //     $validator = Validator::make($request->all(), $rules);


    //     // process the login
    //     if ($validator->fails()) {
    //         return back()->with('error','Something Wrong');
    //     } else {
    //         $data = $request->except(['_token','_method']);
    //         $plan = HostingPlan::where('id', $id)->update($data);
    //         if($plan){
    //         return back()->with('success','Successfully updated');
    //         }else{
    //             return back()->with('error','Something Wrong');
    //         }
    //     }
    // }




    // public function destroy($id)
    // {
    //    // delete
    //     $plan = HostingPlan::find($id);
    //     if($plan->delete()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

}

