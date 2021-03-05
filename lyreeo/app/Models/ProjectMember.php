<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = "project_members";
    protected $primaryKey = "id";
    protected $fillable = ['fk_projectId', "fk_userId", "fk_username"];
}
