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
            $table->string('insurance_no')->nullable();
            $table->date('insu_start_date')->nullable();
            $table->date('insu_end_date')->nullable();
            $table->string('pollution_no')->nullable();
            $table->date('pllu_start_date')->nullable();
            $table->date('pollu_end_date')->nullable();
            $table->string('medical_cert_no')->nullable();
            $table->date('medi_start_date')->nullable();
            $table->date('medi_end_date')->nullable();
            $table->string('fitness_no')->nullable();
            $table->date('fit_start_date')->nullable();
            $table->date('fit_end_date')->nullable();
            $table->string('permite_no')->nullable();
            $table->date('perm_start_date')->nullable();
            $table->date('perm_end_date')->nullable();
            $table->string('tax_permit_no')->nullable();
            $table->date('tax_start_date')->nullable();
            $table->date('tax_end_date')->nullable();
            $table->string('np_permit_no')->nullable();
            $table->date('np_start_date')->nullable();
            $table->date('np_end_date')->nullable();
            $table->string('five_year_no')->nullable();
            $table->date('five_start_date')->nullable();
            $table->date('five_end_date')->nullable();
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
