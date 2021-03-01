<?php
namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use http\Env\Request;
use Validator;
use Auth;
use File;

class ContactDetail extends Model
{

    protected $fillable = ["user_id", "address", "phone","email","website"];
    protected $table = "contact_page_detail";
    protected $primaryKey = "id";

}