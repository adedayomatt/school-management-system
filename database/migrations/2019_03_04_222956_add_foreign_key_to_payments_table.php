<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Student FK
            $table->unsignedInteger('student_id', 10)->change();
            $table->index('student_id');
            $table->foreign('student_id')
                    ->references('id')
                    ->on('students')
                    ->onDelete('cascade');

            // Fee FK
            $table->unsignedInteger('fee_id', 10)->change();
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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['student_id']);
            $table->dropForeign(['student_id']);

            $table->dropIndex(['fee_id']);
            $table->dropForeign(['fee_id']);

        });
    }
}
