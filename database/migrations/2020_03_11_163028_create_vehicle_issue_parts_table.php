<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleIssuePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_issue_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('vehicle_issue_id');
            $table->string('damage_part_name')->nullable();
            $table->bigInteger('cost_part')->nullable();
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
        Schema::dropIfExists('vehicle_issue_parts');
    }
}
