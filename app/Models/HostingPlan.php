<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\AppliedCodes;
use Auth;use Cart;

class HostingPlan extends Model
{
    protected $fillable = [
        'title',
        'price',
        'per',
        'website',
        'bandwidth',
        'storage',
        'ram',
        'db',
        'emails',
        'support',
        'plan_duration',
        'type',
        'discount',
        ];
    protected $table = "hosting_plans";
    protected $primaryKey = "id";

    public function fetchAllPlans(){

        $plans = HostingPlan::all();
        foreach($plans as $index => $plan){
            $plan->plan_duration = json_decode($plan->plan_duration);
            $plan->type          = json_decode($plan->type);
            $plan->discount      = json_decode($plan->discount);
            $plan->price         = json_decode($plan->price);
        }
        return $plans;
    }

    public function fetchSinglePlan($id=null){

        $plan = HostingPlan::where('id',$id)->first();
        $plan->plan_duration = json_decode($plan->plan_duration);
        $plan->type          = json_decode($plan->type);
        $plan->discount      = json_decode($plan->discount);
        $plan->price         = json_decode($plan->price);

        return $plan;
    }

    public function getPlanActualPrice($id=null,$indexID=null,$data=array()){

        $planDetails = $this->fetchSinglePlan($id);
        $data = [
            'plan_duration' => $planDetails->plan_duration[$indexID],
            'discount'      => $planDetails->discount[$indexID],
            'type'          => $planDetails->type[$indexID],
            'price'         => $planDetails->price[$indexID],
            'title'         => $planDetails->title,
        ];
        return $data;
    }


}