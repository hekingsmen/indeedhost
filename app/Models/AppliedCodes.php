<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Auth;


class AppliedCodes extends Model
{

    protected $fillable = ["hosting_plan_id", "hosting_plan_name", "offer_code","offer_discount","discount_amount","user_id","offer_name"];
    protected $table = "applied_codes";
    protected $primaryKey = "id";




}
