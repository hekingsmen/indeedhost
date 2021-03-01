<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\ContactDetail;
use Illuminate\Http\Request;
use App\Models\HostingPlan;
use App\Models\OrderItems;
use App\Models\ContactUs;
use App\Models\Feature;
use App\Mail\Reminder;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Mail;

class HomeController extends Controller{


    public function __construct(){

        //$this->middleware('auth');
    }


    public function index(){

        $plans   = HostingPlan::all();
        $sliders = Slider::all();
        $feature = Feature::all();

        foreach($plans as $index => $plan){
            $plan->plan_duration = json_decode($plan->plan_duration);
            $plan->type          = json_decode($plan->type);
            $plan->discount      = json_decode($plan->discount);
            $plan->price         = json_decode($plan->price);
        }

        return view('forntend.homepage',compact('plans','sliders','feature'));

    }


    public function hosting(){

        $plans = HostingPlan::all();

        foreach($plans as $index => $plan){
            $plan->plan_duration = json_decode($plan->plan_duration);
            $plan->type          = json_decode($plan->type);
            $plan->discount      = json_decode($plan->discount);
            $plan->price         = json_decode($plan->price);
        }

        return view('forntend.hosting',compact('plans'));
    }

    public function getMonths(){
        return array('1','12','24','36');
    }

    public function planConfigure($id=null,$data = array()){

        $plan = HostingPlan::where('id',$id)->first();

        $plan->plan_duration = json_decode($plan->plan_duration);
        $plan->type          = json_decode($plan->type);
        $plan->discount      = json_decode($plan->discount);
        $plan->price         = json_decode($plan->price);

        foreach ($this->getMonths() as $index => $row ){

            $month = $row;

            if($plan->type[$index]=='flat'){
                $discountedAmount = $plan->discount[$index];
            }elseif($plan->type[$index]=='percentage'){
                $discountedAmount = $plan->price[$index] * ( $plan->discount[$index]/100 );
            }

            $data[] = [
                'ActualAmount'       => $plan->price[$index],
                'finalAmount'        => ( $plan->price[$index] - $discountedAmount )*$month,
                'finalMonthlyAmount' => ( $plan->price[$index] - $discountedAmount ),
                'discount'           => $plan->discount[$index],
                'type'               => $plan->type[$index],
                'months'             => $month,
            ];

        }


        return view('forntend.plan_detail',compact('plan','data'));
    }


    public function about(){

        return view('forntend.about');
    }
    

    public function adminHome(){

        return view('admin.home');
    }


    public function remindertousers(){

        $items = OrderItems::whereBetween('expired_at', [Carbon::now(), Carbon::now()->addDays(10)])->get();
        foreach ($items as $item) {
            $order = find($item->order_id);
            $details = [
                'title' => 'Your plan exrpired',
                'body' =>   'Your plan exrpired soon please renew your plan'
            ];

            Mail::to($order->email)->send(new Reminder($details));

        }

        // return view('admin.home');
    }

    public function getAdminId(){
        return User::where('is_admin',1)->pluck('id')->first();
    }

    public function contactUs(){

        $contactDetails = ContactDetail::where('user_id',$this->getAdminId())->first();
        return view('forntend.contact',compact('contactDetails'));
    }



    public function saveContactDetail(Request $request){

        $rules = array(
            'name' => 'required|string',
            'email' => 'nullable|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }else{

            $data = $request->except(['_token','user_id']);
            $userName = $data['name'];
            ContactUs::create($data);

            $details = [
                'title' => 'Contact Us Form',
                'body' =>   "$userName has filled the contact us from with his message"
            ];

            Mail::to("technodeviser04@gmail.com")->send(new Reminder($details));

            return back()->with('success','Successfully sent');
        }

    }

}

