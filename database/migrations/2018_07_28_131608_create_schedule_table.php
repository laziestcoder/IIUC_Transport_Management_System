<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day');
            $table->boolean('toiiuc')->default(false)->nullable();
            $table->boolean('fromiiuc')->default(false)->nullable();
            $table->boolean('male')->default(false)->nullable();
            $table->boolean('female')->default(false)->nullable();
            $table->integer('time')->length(3);
            $table->integer('bususer')->length(2)->default(0);// 1 Student || 2 Faculty || 3 Officer/Staff
            $table->integer('route')->length(2);
            $table->boolean('active')->default(false)->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('schedule');
    }
}
