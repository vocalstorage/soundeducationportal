<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('place');
            $table->string('street');
            $table->string('number');
            $table->string('postal_code');
            $table->integer('teacher_id')->unsigned();
            $table->integer('filepath_id')->unsigned();
            $table->timestamps();

            $table->foreign('teacher_id')
                ->references('id')->on('teachers')->onDelete('cascade');

            $table->foreign('filepath_id')
                ->references('id')->on('filepaths');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
    }
}
