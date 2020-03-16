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
            $table->string('damage_part_name_1')->nullable();
            $table->bigInteger('cost_part_1')->nullable();
            $table->string('damage_part_name_2')->nullable();
            $table->bigInteger('cost_part_2')->nullable();
            $table->string('damage_part_name_3')->nullable();
            $table->bigInteger('cost_part_3')->nullable();
            $table->string('damage_part_name_4')->nullable();
            $table->bigInteger('cost_part_4')->nullable();
            $table->string('damage_part_name_5')->nullable();
            $table->bigInteger('cost_part_5')->nullable();
            $table->string('damage_part_name_6')->nullable();
            $table->bigInteger('cost_part_6')->nullable();
            $table->string('damage_part_name_7')->nullable();
            $table->bigInteger('cost_part_7')->nullable();
            $table->string('damage_part_name_8')->nullable();
            $table->bigInteger('cost_part_8')->nullable();
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
