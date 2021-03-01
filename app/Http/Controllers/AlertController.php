<?php

namespace App\Http\Controllers;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\HostingPlan;
use App\Models\OrderItems;
use App\Models\Order;
use App\Models\User;
use carbon\Carbon;
use Cart;
use Auth;
use Mail;

class AlertController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index() {

        $carts =  Cart::content();
        $allOrdersPlans = OrderItems::leftJoin('orders','orders.id', '=','order_items.order_id')->where('orders.payment_status','paid')->select('order_items.*', 'orders.sub_total as sub_total','orders.total_amount as total_amount','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.name as name','orders.email as email','orders.phone as phone')->get();
        echo Carbon::now()."<br><br>";

        foreach ($allOrdersPlans as $key => $value) {

            $planId             = $value->hosting_plan_id;
            $planActivationDate = Carbon::parse($value->created_at);
            $planExpiryDate     = Carbon::parse($value->expired_at);

            if(empty($planExpiryDate)){
                echo "kahli--------";
                $planValidity          = HostingPlan::where(['id'=>$planId])->pluck('per')->first();
                $getPlanActivationDate = Carbon::parse($planActivationDate);
                $planExpiryDate        = $getPlanActivationDate->addMonth($planValidity);
                $planExpiryDate        = Carbon::parse($planExpiryDate);
            }

            if(Carbon::now() <= $planExpiryDate){
                $date_diff='';
                $date_diff=$planExpiryDate->diffInDays(Carbon::now());
                if($date_diff <= 30){
                    // $this->sentMail($value,$date_diff);
                    echo "==".$value->id."==".$planActivationDate."==".$planExpiryDate."==".$date_diff."<br><br>";
                }

            }

            // $different_days = $planExpiryDate->diffInDays(Carbon::now());
            // echo $planActivationDate."----".$planExpiryDate."-----".$different_days."<br>";

            // if(Carbon::now() >= $planExpiryDate){
                // $this->sentMail($value);
            // }
        }
        die;
    }

    public function sentMail($detail=null,$days_diff=null){
        
        $user_detail = User::where('id',$detail->user_id)->first(['name','email']);
        $planDetail = HostingPlan::find($detail->hosting_plan_id);
        
        if(!empty($user_detail)){

            $content = EmailTemplate::find(4);
            $address = $user_detail->email;
            $name = $user_detail->name;
            $subject = $content->template_subject;
            
            $email_content = str_replace('[RECEIVER NAME]', $name, $content->template_content);
            $email_content = str_replace('[PLAN NAME]', $detail->item_name, $email_content);
            // $email_content = str_replace('[DAYS LEFT]', $days_diff, $email_content);
            
            $data = array();
            $data['test_message'] = $email_content;
        
                Mail::send('emails.plan_reminder', $data, function($message) use($address, $name, $subject) {
                    $message->to($address, $name)->subject($subject);
                });
            
        }
        
    }


}
