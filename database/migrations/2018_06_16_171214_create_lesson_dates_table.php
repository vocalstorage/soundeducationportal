<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('time');
            $table->integer('registrations');
            $table->boolean('warning')->default(false);
            $table->integer('lesson_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->timestamps();

            $table->foreign('lesson_id')
                ->references('id')->on('lessons')->onDelete('cascade');

            $table->foreign('teacher_id')
                ->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_dates');
    }
}
