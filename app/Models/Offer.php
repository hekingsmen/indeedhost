<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\AppliedCodes;
use Auth;
use Cart;
use File;
use carbon\Carbon;

class Offer extends Model
{

    protected $fillable = [
        "name",
        "description",
        "type","code",
        "expiry_date",
        "min_package_amount",
        "max_discount",
        "specific_item",
        "restricted_item"
    ];
    protected $table = "offers";
    protected $primaryKey = "id";


    public function validateOfferDetails($request){

        return $validator = Validator::make($request->all(), [

            'name'=>'required|string',
            'description'=>'required|string',
            'type'=>'required|string',
            'code'=>'required|string',
            'start_date'=> 'required|date|date_format:Y-m-d|before:expiry_date',
            'expiry_date'=> 'required|date|date_format:Y-m-d|after:start_date',
            'min_discount'=>'nullable|string',
            'max_discount'=>'nullable|string',
            'specific_item'=>'nullable',
            'restricted_item'=>'nullable',
        ]);

    }

    public function saveOfferDetails($params=null){

        $id = $params['id'];
        unset($params['id']);

        if(isset($params['specific_item'])){
            $params['specific_item'] = json_encode($params['specific_item']);
        }

        if(isset($params['restricted_item'])){
            $params['restricted_item'] = json_encode($params['restricted_item']);
        }

        if($id!=null){
            unset($params['_method']);
            Offer::where('id',$id)->update($params);
        }else{
            Offer::create($params);
        }



    }

    public function checkValidOfferCode($params=null){

        if(!empty($params['code']) && !empty($params['id']) ){
            $check = Offer::where('id','!=',$params['id'])->where('code',$params['code'])->get();
        }
        if(count($check)>0){
            return true;
        }else{
            return false;
        }
    }

    public function checkForValidCode($code=null){

        $response = array();
        $offer = Offer::where('code',$code)->first();

        if($offer!=null){

            $expiryDate    = Carbon::parse($offer->expiry_date);
            $currentDate   = Carbon::now();

            if($expiryDate > $currentDate){

                if( $offer->min_package_amount < str_replace(',','',Cart::subtotal())  ){

                    $response = $this->applyDiscount($offer);

                }else{

                    $response['msg']     = "To avail this discount, your total cart amount should be more than ".$offer->min_package_amount." INR.";
                    $response['success'] = false;

                }

                return $response;

            }else{

                $response['msg']     = "Entered code is expired.";
                $response['success'] = false;
            }


        }else{
            $response['msg']     = "Entered code is invalid.";
            $response['success'] = false;
        }

        return $response;
    }

    public function applyDiscount($offer=array(),$restrictedItem=array(),$specificItem=array()){

        $response = array();
        $restrictedItem = json_decode($offer->restricted_item);
        $specificItem = json_decode($offer->specific_item);

        foreach(Cart::content() as $index => $content){

            $response = $this->setDiscountByType($offer,$content);
//            if(!empty($specificItem) && count($specificItem)>0){
//                if( in_array($content->id,$specificItem) && !in_array($content->id,$restrictedItem) ){
//
//                    $response = $this->setDiscountByType($offer,$content);
//                }
//
//            }else{
//                    $response = $this->setDiscountByType($offer,$content);
//            }
        }

        return $response;

    }



    public function setDiscountByType($offer=array(),$package=array(),$options=array()){

        $afterTaxPrice = ($package->taxRate/100)*$package->price;
        $discountAmount = ($offer->max_discount/100)* ( $afterTaxPrice + $package->price );

        $totalDiscount  = $package->discountRate + $offer->max_discount ;

        $container = array();

        foreach(Cart::content() as $cart){
            if($cart->id == $package->id && $cart->name == "child_entry" && $cart->options['code'] == $offer->code ){
                $container[] = $cart;
            }
        }

        if( count($container) == 0 && count($container) < 1 ){
//            echo "will add"; die;
            $childRow = Cart::add(['id' => $package->id,
                'name' => "child_entry",
                'qty' => 1, 'price' =>0,
                'weight' => 0,'options' => [
                        'offer_name' =>$offer->name,
                        'discount' =>$offer->max_discount,
                        'code'=>$offer->code,
                        'packageName'=>$package->title,
                        'packageAmount'=>$package->price,
                        'parent_rowId'=>$package->rowId,
                        'childRow'=>null,
                        'discountAmount'=>$discountAmount,
                        'type'=>$offer->type
                    ]]);

            $options = Cart::get($package->rowId);

            $data = [
                'plan_duration' => $options->options['plan_duration'],
                'discount' => $options->options['discount'],
                'type' =>$options->options['type'],
                'price' => $options->options['price'],
                'childRow' => $childRow->rowId,
                'parent_rowId' => null,
            ];

            Cart::update($package->rowId, ['options'  => $data ]);

            if( $offer['type'] == 'discount' && $offer['discount'] != 0 ){

                Cart::setDiscount($cart->rowId, $offer['discount']);

            }elseif( $offer['type'] == 'flat' && $offer['discount'] != 0 ){

                $percentage = $offer['discount'] / $offer['price'] ;
                $percentage = $percentage * 100 ;

                Cart::setDiscount($package->rowId,$percentage);
            }


//            Cart::setDiscount($package->rowId,$offer->max_discount);

            $response['msg']     = "Entered code applied successfully.";
            $response['success'] = true;
            $response['reload'] = true;

        }else{
//          echo "will not add"; die;
            $container = '';
            $response['msg']     = "Code can not be applly twice.";
            $response['success'] = true;

        }

//        Cart::destroy();
//        $this->removeExtra();

        return $response;
    }

    public function removeExtra(){
//        echo "<pre>"; print_r(Cart::content()); die;
        foreach(Cart::content() as $index => $cart){
            if($cart->name=="child_entry"){

            }

        }
    }



}
