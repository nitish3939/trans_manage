<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->bigInteger('opening_cashin')->nullable();
            $table->bigInteger('sundry_debtors_cashin')->nullable();
            $table->bigInteger('sundry_creditors_cashin')->nullable();       
            $table->bigInteger('sundry_debtors_cashout')->nullable();
            $table->bigInteger('sundry_creditors_cashout')->nullable();  
            $table->bigInteger('expenses')->nullable();
            $table->bigInteger('closing_balances')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
