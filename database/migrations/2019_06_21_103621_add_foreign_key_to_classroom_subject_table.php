<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToClassroomSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classroom_subject', function (Blueprint $table) {
            $table->index('classroom_id');
            $table->foreign('classroom_id')
                    ->references('id')
                    ->on('classrooms')
                    ->onDelete('cascade');
            });

        Schema::table('classroom_subject', function (Blueprint $table) {
            $table->index('subject_id');
            $table->foreign('subject_id')
                    ->references('id')
                    ->on('subjects')
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
        Schema::table('classroom_subject', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropIndex(['classroom_id']);

            $table->dropForeign(['subject_id']);
            $table->dropIndex(['subject_id']);

        });
    }
}
