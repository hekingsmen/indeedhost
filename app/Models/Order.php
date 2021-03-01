<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['user_id','order_id','razorpay_signature','sub_total','quantity','expired_at','total_amount','name','country','post_code','address','address2','phone','email','payment_method','payment_status','payment_id','coupon'];


    public function items()
    {
        return $this->hasMany('App\Models\OrderItems');
    }

    // public function items_process() {
    //     return $this->items()->where('status','=', 'process');
    // }

    // public function items_completed() {
    //     return $this->items()->where('status','=', 'completed');
    // }
    
    // public function items_cancel() {
    //     return $this->items()->where('status','=', 'cancel');
    // }


}
