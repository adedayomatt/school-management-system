<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('surname');
            $table->string('other_names');
            $table->string('gender');
            $table->date('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('first_appointment')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('town')->nullable();
            $table->string('village')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('classroom_id')->nullable();
            $table->integer('admin')->default(0);
            $table->string('passport')->nullable();
            $table->string('src')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('staff');
    }
}
