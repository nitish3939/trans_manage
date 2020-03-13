<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('vehicle_id');
            $table->date('issue_date')->nullable();
            $table->string('issue_name')->nullable();
            $table->string('mechnic_name')->nullable();
            $table->string('labour_charge')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('total_charge')->nullable();
            $table->string('bill_image')->nullable();
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
        Schema::dropIfExists('vehicle_issues');
    }
}
