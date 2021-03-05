<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Cart;
use Auth;
use carbon\Carbon;
use App\Models\HostingPlan;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\AppliedCodes;
use Razorpay\Api\Api;

class CartController extends Controller
{


    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request){
//                Cart::destroy();
//        echo "<pre>"; print_r(Cart::content()); die;
        $input = $request->all();

        if(!empty($input['offerCode'])){

            Cart::setGlobalDiscount(50);
        }

        return view('cart');

    }


    public function clearCart(){
        $countCart = array();

        foreach(Cart::content() as $cart){
            $countCart[] = $cart;
        }

        if(count($countCart)!=0){
            $this->cartDestroyed();
        }
    }


    public function applyCode(Request $request){

        $input = $request->all();

        if(!empty($input['code'])){

            $response = (new Offer)->checkForValidCode($input['code']);
        }

        return $response;
    }


    public function checkForAvailability($arr = array()){

        $data = \Cart::content();
        foreach ($data as $key => $value) {
            $arr[] = $value->id;
        }
        return $arr;
    }


    public function removeIfAvailable($id=null){

        $data = \Cart::content();
        foreach ($data as $key => $value) {
            if($value->id == $id ){
                Cart::remove($value->rowId);
            }
        }
    }


    public function addcart(int $id, Request $request) {

        $price = '';
        $getDetails = (new HostingPlan)->getPlanActualPrice($id,$request->duration);
        $data = [
            "plan_duration" => $getDetails['plan_duration'],
            "discount" => $getDetails['discount'],
            "type" => $getDetails['type'],
            "price" => $getDetails['price'],
            "title" => $getDetails['title'],
        ];

        $this->removeIfAvailable($id);

        if($getDetails['type']=='flat'){

            $price = ( $getDetails['price'] * $getDetails['plan_duration']) ;
        }elseif($getDetails['type']=='percentage'){

            $price = $getDetails['price'] * $getDetails['plan_duration'];
        }
        
        $cart = \Cart::add(['id' => $id, 'name' => $getDetails['title'], 'qty' => 1, 'price' => $price ,'weight' => 550,'options' => $data ]);

        Cart::setGlobalTax(0);
        //set tax to 0 globally

        if( $getDetails['type'] == 'percentage' && $getDetails['discount'] != 0 ){

            Cart::setDiscount($cart->rowId, $getDetails['discount']);
        }elseif( $getDetails['type'] == 'flat' && $getDetails['discount'] != 0 ){

            $percentage = $getDetails['discount'] / $getDetails['price'] ;
            $percentage = $percentage * 100 ;

            Cart::setDiscount($cart->rowId, $percentage );
        }

        $msg = "Product has been successfully added to the Cart.";
        return redirect()->route('cart')->with('success',$msg);

    }


    public function deletecart($rowId){

        Cart::remove($rowId);

         return redirect()->back()->with('success','Product has been successfully Removed to the Cart.');
    }



    public function checkout(){

        $country = Country::all();
        return view('checkout',compact('country'));
    }


    public function saveAppliedCodes($data = array()){
        
        foreach (Cart::content() as $index => $cart){
            if($cart->name == 'child_entry'){

                $data = [
                    'hosting_plan_id' => $cart->id,
                    'hosting_plan_name' => $cart->options['packageName'],
                    'offer_code' => $cart->options['code'],
                    'offer_discount' => $cart->options['discount'],
                    'discount_amount' => $cart->options['discountAmount'],
                    'user_id' => Auth::user()->id,
                    'offer_name' => $cart->options['offer_name'],
                ];

                $res = AppliedCodes::create($data);

            }
        }
    }


    public function checkoutPost($method, Request $request){

        if($method =='paypal'){
            $orderid = uniqid();
            $orderdata['order_id'] =$orderid;
        }else{
            $razorderamount = (float) str_replace(',', '', Cart::total())*100;
            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
            $razorder  = $api->order->create(array('receipt' => uniqid(), 'amount' =>$razorderamount, 'currency' => env('RAZOR_CURRENCY')));
            $orderdata['order_id'] = $razorder->id;
        }
        //dd($data);
        $user =  Auth::user();
        $orderdata['email'] =$user->email;
        $orderdata['name'] =$user->name;
        $orderdata['user_id'] =$user->id;
        $orderdata['sub_total'] = (float) str_replace(',', '', Cart::total());
        $orderdata['payment_method'] =$method;
        $order = Order::create($orderdata);

        $carts =  Cart::content();
        //echo"<pre>";print_r($carts);die;
        $this->saveAppliedCodes($carts);
        foreach ($carts as $cart) {
            if($cart->name!="child_entry"){
                $tax_price = ($cart->price * $cart->taxRate)/100 ;
                if(!empty($cart->discountRate)){
                    $dicount_price = ($cart->price * $cart->discountRate)/100 ;
                }else{
                    $dicount_price = 0;
                }

                $item['order_id'] = $order->id;
                $item['user_id']  = $user->id;
                $item['hosting_plan_id'] = $cart->id;
                $item['item_name'] = $cart->name;
                $item['item_price'] = $cart->price;
                $item['taxrate'] = $cart->taxRate;
                $item['discountRate'] = $cart->discountRate;
                $item['total_price'] = $tax_price + $cart->price - $dicount_price ;
//                $item['duration'] = $cart->options->duration;
                $item['duration'] = $cart->options['plan_duration'];
                $item['expired_at'] = Carbon::now()->addMonth($cart->options->duration);
                OrderItems::create($item);
            }
        }


       // Cart::destroy();
        
        if($method =='paypal'){
            $data['business']=env('PAYPAL_API_USERNAME');
            $data['cmd']='_xclick';
            $data['amount']=$orderdata['sub_total'];
            $data['currency_code']=env('PAYPAL_CURRENCY');
            $data['item_name']='Buy hosting plan';
            // $data['item_number']='1231';
            $data['order_id']=$orderid;
            $data['cancel_return']=route('paymentCancel');
            $data['return']=route('paymentSuccess',['token'=>'success','order_id'=>$orderid]);
            $url = $this->paypalPaymentGetToken($data);
            if($url){
                $urlarr = explode(" ",$url);
                return redirect($urlarr[3]);
            }else{
                die("Error: No response.");
            }
        }else{
            //echo"<pre>";print_r($razorder);die;
            $pay['order_id'] = $razorder->id;
            $pay['amount'] = $razorderamount;
            $pay['username'] = $order->name;
            $pay['useremail'] = $order->email;
            $pay['ordername'] = "hosting";
            $pay['description'] = "Buy hosting plan";
            $pay['currency'] = env('RAZOR_CURRENCY');
            $pay['address'] = $order->address;

            return view('razorpay', compact('pay'));

            //return response()->json($pay);

            // $btn = '<form action="'.route('paymentSuccess').'" method="POST">
            // <script
            //     src="https://checkout.razorpay.com/v1/checkout.js"
            //     data-key="'.env('RAZOR_KEY').'" 
            //     data-amount="'.$razorder->amount.'" 
            //     data-currency="INR"
            //     data-order_id="'.$razorder->id.'"
            //     data-buttontext="Pay with Razorpay"
            //     data-name="Acme Corp"
            //     data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
            //     data-image="https://example.com/your_logo.jpg"
            //     data-prefill.name="'.$order->name.'"
            //     data-prefill.email="'.$order->email.'"
            //     data-theme.color="#F37254"
            // ></script>
            // <input type="hidden" name="_token" value="'.csrf_token().'">
            // <input type="submit" name="submit" id="razoresubmit">
            // </form>';
            //return $btn;
        }
        
    }



    public function paymentCancel(){
        echo "PayPal Transaction Cancel";
    }


    public function paymentSuccess(Request $request){
        if($request->token =='success'){
            $order = Order::where('order_id',$request->order_id)->first();
            //dd($order);
            $order->update(['payment_status'=>'paid','payment_id'=>uniqid()]);
            Cart::destroy();
            return redirect()->route('home')->with('success','Thanks you for purchased');
        }
    }


    public function razorpaySuccess(Request $request){

        if(isset($request->razorpay_payment_id)){
            $order = Order::where('order_id',$request->razorpay_order_id)->first();
            $data= [
                'payment_status'=>'paid',
                'payment_id'=>$request->razorpay_payment_id,
                'order_id'=>$request->razorpay_payment_id,
                'razorpay_signature'=>$request->razorpay_signature,
                ];
            $order->update($data);
            Cart::destroy();
            $this->cartDestroyed();
            return redirect()->route('home')->with('success','Thanks you for purchased');
        }else{
            return redirect()->route('home')->with('error','Payment Failed');
        }
    }

    public function paypalPaymentGetToken($data){

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, env('PAYPAL_API'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        // curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public function cartDestroyed(){

        $countCart = array();
        foreach(Cart::content() as $cart){
            $countCart[] = $cart;
        }

        if(count($countCart)!=0){
            $this->cartDestroyed();
        }
    }

}
