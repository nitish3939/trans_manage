<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilties', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('trip_id');
            $table->bigInteger('vehicle_id');
            $table->string('consignor_name')->nullable();
            $table->string('consignor_address')->nullable();
            $table->string('consignor_gst')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('consignee_address')->nullable();
            $table->string('consignee_gst')->nullable();
            $table->bigInteger('invoice_no')->nullable();
            $table->bigInteger('eway_bill_no')->nullable();
            $table->bigInteger('value')->nullable();
            $table->string('charged')->nullable();
            $table->string('delivery_at')->nullable();
            $table->bigInteger('gr_no')->nullable();
            $table->string('freight')->nullable();
            $table->string('waiting')->nullable();
            $table->string('labour')->nullable();
            $table->bigInteger('toll')->nullable();
            $table->bigInteger('cgst')->nullable();
            $table->bigInteger('sgst')->nullable();
            $table->bigInteger('igst')->nullable();
            $table->bigInteger('g_total')->nullable();
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
        Schema::dropIfExists('bilties');
    }
}
