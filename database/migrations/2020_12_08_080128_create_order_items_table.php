<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('hosting_plan_id');
            $table->string('order_id');
            $table->string('user_id')->nullable();
            $table->string('item_name')->comment('plan name');
            $table->string('item_price');
            $table->string('total_price');
            $table->string('taxrate')->nullable();
            $table->string('discountRate')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('domain')->nullable();
            $table->enum('status',['process','completed','cancel'])->default('process');
            $table->string('duration')->nullable();;
            $table->string('expired_at')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
