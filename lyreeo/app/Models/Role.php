<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'admin_panel',
        'project_management_panel',
        'reporting_panel',
        'front_end_view_panel',
        'alerts',
        'is_active'
    ];

    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $sortOrder = 'asc';
    public $sortEntity = 'roles.id';


    public function saveRole($data=null){
        $res = self::create($data);
        if($res){
            return response()->json(['success'=>"Role has created"]);
        }else{
            return response()->json(['success'=>"Something went wrong"]);
        }
    }
}
