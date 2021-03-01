<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routesmanager extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'route_slag',
        'route_url',
        'module_name',
        'route_action',
    ];

}
