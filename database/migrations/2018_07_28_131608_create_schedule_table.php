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
            $table->boolean('toiiuc')->default(false);
            $table->boolean('fromiiuc')->default(false);
            $table->boolean('male')->default(false);
            $table->boolean('female')->default(false);
            $table->integer('time');
            $table->integer('user')->length(1)->default(1);// 1 Student || 2 Faculty || 3 Officer/Staff
            $table->boolean('route')->default(true); //ALL ROUTE -true or AK KHAN-false
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
