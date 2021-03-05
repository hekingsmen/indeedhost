<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('addon_key');
            $table->string('title');
            $table->string('actions');
            $table->string('db_table');
            $table->enum('status',['1','0'])->default('1')->comment('1 = Active, 0 = Un-Active');
            $table->enum('visibility',['1','0'])->default('1')->comment('1 = Published, 0 = Unpublished');
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
        Schema::dropIfExists('addons');
    }
}
