<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('otp')->nullable();
            $table->bigInteger('user_type_id')->default(0);
            $table->string('email_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_pic_path')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->bigInteger('bank_account_no')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('aadhar_id_front')->nullable();
            $table->string('aadhar_id_back')->nullable();
            $table->string('voter_id')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_id')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->string('remember_token')->nullable();
            $table->string('created_by')->default(0);
            $table->string('updated_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
