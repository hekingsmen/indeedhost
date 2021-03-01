<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

class ContactUs extends Model
{

    protected $fillable = ["name", "email", "subject",'message'];
    protected $table = "contactus";
    protected $primaryKey = "id";


}