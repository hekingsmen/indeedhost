<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesmanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routesmanagers', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('route_slag')->nullable();
            $table->string('route_url')->unique();
            $table->string('module_name');
            $table->string('route_action');
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
        Schema::dropIfExists('routesmanagers');
    }
}
