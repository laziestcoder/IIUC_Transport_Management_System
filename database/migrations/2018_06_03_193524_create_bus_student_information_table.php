<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusStudentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_student_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('routeid');
            $table->integer('pointid');
            $table->integer('studentno');
            $table->integer('dayid');
            $table->integer('timeid');
            $table->boolean('gender')->default(null);
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
        Schema::dropIfExists('bus_student_information');
    }
}
