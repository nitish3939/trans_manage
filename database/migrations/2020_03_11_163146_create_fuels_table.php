<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('trip_id');
            $table->bigInteger('user_id');
            $table->bigInteger('vehicle_id');
            $table->string('fuel_bill_image')->nullable();
            $table->bigInteger('payment')->nullable();
            $table->string('start_meter')->nullable();
            $table->string('end_meter')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('fuels');
    }
}
