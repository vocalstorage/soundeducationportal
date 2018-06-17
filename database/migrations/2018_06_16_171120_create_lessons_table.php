<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->date('deadline');
            $table->integer('max_registration');
            $table->integer('schoolgroup_id')->unsigned();
            $table->integer('filepath_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('schoolgroup_id')
                ->references('id')->on('schoolgroups')->onDelete('cascade');

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
        Schema::dropIfExists('lessons');
    }
}
