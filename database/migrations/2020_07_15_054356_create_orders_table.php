<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //$table->string('order_number')->unique();
            $table->string('order_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->string('user_id')->nullable();
            $table->float('sub_total');
            $table->string('payment_id')->nullable();
            $table->float('coupon')->nullable();
            $table->float('total_amount')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('payment_method',['razorpay','paypal']);
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            //$table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('SET NULL');
            $table->string('name')->nullable();
            //$table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
