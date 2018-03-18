<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_date_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

           // $table->foreign('lesson_dates_id')->references('id')->on('lesson_dates');
           // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_registrations');
    }
}
