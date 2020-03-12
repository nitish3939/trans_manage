<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_no')->nullable();
            $table->string('rc_no')->nullable();
            $table->string('vehicle_owner_name')->nullable();
            $table->bigInteger('insurance_no')->nullable();
            $table->dateTime('insu_start_date')->nullable();
            $table->dateTime('insu_end_date')->nullable();
            $table->bigInteger('pollution_no')->nullable();
            $table->dateTime('pllu_start_date')->nullable();
            $table->dateTime('pollu_end_date')->nullable();
            $table->bigInteger('medical_cert_no')->nullable();
            $table->dateTime('medi_start_date')->nullable();
            $table->dateTime('medi_end_date')->nullable();
            $table->bigInteger('fitness_no')->nullable();
            $table->dateTime('fit_start_date')->nullable();
            $table->dateTime('fit_end_date')->nullable();
            $table->bigInteger('permite_no')->nullable();
            $table->dateTime('perm_start_date')->nullable();
            $table->dateTime('perm_end_date')->nullable();
            $table->bigInteger('tax_permit_no')->nullable();
            $table->dateTime('tax_start_date')->nullable();
            $table->dateTime('tax_end_date')->nullable();
            $table->bigInteger('np_permit_no')->nullable();
            $table->dateTime('np_start_date')->nullable();
            $table->dateTime('np_end_date')->nullable();
            $table->bigInteger('five_year_no')->nullable();
            $table->dateTime('five_start_date')->nullable();
            $table->dateTime('five_end_date')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
