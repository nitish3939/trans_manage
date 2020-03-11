<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('commision_type', ['monthly', 'daily'])->nullable();
            $table->bigInteger('work_amount')->default(0);
            $table->string('bribe')->nullable();
            $table->string('company_name')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('commision_charge')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
