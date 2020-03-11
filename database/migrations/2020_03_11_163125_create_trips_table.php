<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('vehicle_id');
            $table->string('start_trip')->nullable();
            $table->string('fuel_entry')->nullable();
            $table->string('end_trip')->nullable();
            $table->string('start_km')->nullable();
            $table->string('end_km')->nullable();
            $table->bigInteger('expense_amount')->nullable();
            $table->bigInteger('amount_spend')->nullable();
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
        Schema::dropIfExists('trips');
    }
}
