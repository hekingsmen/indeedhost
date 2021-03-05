<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    protected $table = "business_units";
    protected $primaryKey = "id";
    protected $fillable = ['department_name', "picture", "is_hidden"];

    public $sortOrder = 'asc';
    public $sortEntity = 'business_units.id';






}
