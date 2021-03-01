<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'addon_key',
        'title',
        'actions',
        'db_table',
        'status',
        'visibility',
    ];
}
