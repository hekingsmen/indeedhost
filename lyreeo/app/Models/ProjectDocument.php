<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    protected $table = "project_documents";
    protected $primaryKey = "id";
    protected $fillable = ["fk_projectId", "document", "is_public"];
}