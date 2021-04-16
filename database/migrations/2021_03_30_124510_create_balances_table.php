<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->bigInteger('profit_adjusted')->nullable();
            $table->bigInteger('duties_taxes')->nullable();
            $table->bigInteger('sundry_creditors')->nullable();
            $table->bigInteger('suspense')->nullable();
            $table->bigInteger('bank')->nullable();
            $table->bigInteger('cash')->nullable();
            $table->bigInteger('sundry_debtors')->nullable();
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
        Schema::dropIfExists('balances');
    }
}
