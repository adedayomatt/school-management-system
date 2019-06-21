<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToClassroomFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classroom_fee', function (Blueprint $table) {
            $table->index('classroom_id');
            $table->foreign('classroom_id')
                    ->references('id')
                    ->on('classrooms')
                    ->onDelete('cascade');
            });

        Schema::table('classroom_fee', function (Blueprint $table) {
            $table->index('fee_id');
            $table->foreign('fee_id')
                    ->references('id')
                    ->on('fees')
                    ->onDelete('cascade');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classroom_fee', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropIndex(['classroom_id']);

            $table->dropForeign(['fee_id']);
            $table->dropIndex(['fee_id']);

        });
    }
}
