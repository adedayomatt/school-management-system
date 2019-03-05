<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname');
            $table->string('other_names');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('former_sch')->nullable();
            $table->string('former_sch_class')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('town')->nullable();
            $table->string('village')->nullable();
            $table->string('home_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('ailment')->nullable();
            $table->integer('siblings')->nullable();
            $table->string('seeking_admission_into')->nullable();
            $table->integer('admitted_into')->nullable();
            $table->string('parents_email')->nullable();
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
        Schema::dropIfExists('enrollments');
    }
}
