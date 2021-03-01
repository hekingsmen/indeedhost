<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class OrderItems extends Model

{

    use HasFactory;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'hosting_plan_id',

        'item_price',

        'order_id',

        'user_id',

        'status',

        'item_name',
        
        'total_price',

        'taxrate',

        'expired_at',

        'duration',

        'domain',

        'password',

        'username',

        'massage',

    ];

}

