<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->bigInteger('price');
            $table->string('per')->nullable();
            $table->string('website');
            $table->string('storage');
            $table->string('bandwidth');
            $table->string('ram');
            $table->string('db');
            $table->string('emails');
            $table->string('support');
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
        Schema::dropIfExists('hosting_plans');
    }
}
