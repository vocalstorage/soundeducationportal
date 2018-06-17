<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonDateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_date_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skill');
            $table->boolean('presence')->default(false);
            $table->text('comment')->nullable();
            $table->integer('lesson_id')->unsigned();
            $table->integer('lesson_date_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lesson_id')
                ->references('id')->on('lessons')->onDelete('cascade');

            $table->foreign('lesson_date_id')
                ->references('id')->on('lesson_dates')->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_date_registrations');
    }
}
