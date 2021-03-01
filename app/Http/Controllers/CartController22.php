<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Cart;
use Auth;
use App\Models\HostingPlan;
use App\Models\Order;

class CartController extends Controller
{
    private $clientid ='';
    private $secrectid ='';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->clientid ="AefW2iBD7U9Tap_LjlhAYswXjMSY8Lnxe8Rq3gUKGJLOhFD_aYGhizpo4zcIy03wM9dOhlciVVpUoN4e";
        $this->secrectid ="EOWgHOEm4I5T8GDfIxm119bTdmzv6L7GqTfZGlbv_f2pZhksdWe3moZUmHhYlj5Vjo8vqVQEiq94e99r";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cart');
    }

    public function addcart(int $id) {
        /* Define some defaults */
        $basePrice = 42.42;
        $plan = HostingPlan::find($id);
        /* Add the product */
        \Cart::add($id,  $plan->title, 1,$plan->price, 500);

        /* Redirect to prevend re-adding on refreshing */
        return redirect()->route('cart')->with('success','Product has been successfully added to the Cart.');
    }

    public function deletecart($rowId){
        Cart::remove($rowId);
         return redirect()->back()->with('success','Product has been successfully Removed to the Cart.');
    }

    public function checkout(){
        $country = Country::all();
        return view('checkout',compact('country'));
    }

    public function checkoutPost($method, Request $request){
        $cart =  Cart::content();
        $user =  Auth::user();
        $orderdata['email'] =$user->email;
        $orderdata['name'] =$user->name;
        $orderdata['user_id'] =$user->id;
        $orderdata['sub_total'] =Cart::subtotal();
        $orderdata['total_amount'] =Cart::priceTotal();
        $orderdata['quantity'] ='1';
        $orderdata['payment_method'] =$method;
        $orderdata['payment_status'] ='unpaid';
        $orderdata['status'] ='new';
        //echo"<pre>";print_r($orderdata);die;
        Order::insert($orderdata);
        if($method =='paypal'){
            $data['business']="t.test283-facilitator@yahoo.in";
            $data['cmd']='_xclick';
            $data['amount']=Cart::priceTotal();
            $data['currency_code']='USD';
            $data['item_name']='test';
            $data['item_number']='1231';
            $data['orderid']='13135';
            $data['cancel_return']=route('paymentCancel');
            $data['return']=route('paymentSuccess');
            //$url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
            $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
            $url = $this->paypalPaymentGetToken($data,$url);
            $json = json_decode($url);
            $pay = $this->paypalPaymentCheckout($json->access_token);
            echo"<pre>"; print_r($pay);die;
            if($url){
                $urlarr = explode(" ",$url);
                return redirect($urlarr[3]);
            }else{
                die("Error: No response.");
            }
        }
        
    }

    public function paymentCancel(){
        echo "PayPal Transaction Cancel";
    }

    public function paymentSuccess(Request $request){
        echo"<pre>";print_r($request->all()); die;
    }

    public function paypalPaymentGetToken($data,$paypalurl){
        $ch = curl_init();
    
        // curl_setopt($ch, CURLOPT_URL, $paypalurl);
        // curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_URL, $paypalurl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientid.":".$this->secrectid);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function paypalPaymentCheckout($token){

        $headers = array(
            'Content-type: application/json',
            'Accept: application/json',
            'Authorization:Bearer '.$token,
        );

        $data = '{
            "intent": "sale",
                "payer": {
                "payment_method": "credit_card",
                "payer_info": {
                "email": "test@test.com",
                "shipping_address": {
                "recipient_name": "parmod",
                "line1": "mohali",
                "city": "mohali",
                "country_code": "IND",
                "postal_code": "147105",
                "state": "punjab",
                "phone": "+917894587624"
            },
            "billing_address": {
            "line1": "mohali",
            "city": "mohali",
            "state": "punjab",
            "postal_code": "147105",
            "country_code": "IND",
            "phone": "+917894587624"
            }
            },
            "funding_instruments": [{
            "credit_card": {
            "number": "4111111111111111",
            "type": "visa",
            "expire_month": "12",
            "expire_year": "23",
            "cvv2": "123",
            "first_name": "parmod",
            "last_name": "parmod",
            "billing_address": {
            "line1": "mohali",
            "city": "mohali",
            "country_code": "IND",
            "postal_code": "147105",
            "state": "punjab",
            "phone": "+917894587624"
                        }
                    }
                }]
            },
            "transactions": [{
            "amount": {
            "total": "20",
            "currency": "USD"
            },
            "description": "This is member subscription payment at Thecodehelpers.",
            "item_list": {
            "shipping_address": {
            "recipient_name": "parmod",
            "line1": "mohali",
            "city": "mohali",
            "country_code": "IND",
            "postal_code": "147105",
            "state": "punjab",
            "phone": "+917894587624"
                        }
                    }
                }]
            }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/checkout/orders');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        //curl_setopt($ch, CURLOPT_USERPWD, $this->clientid.":".$this->secrectid);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
