<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulestudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulestudent', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('day');
            $table->integer('pickpoint');
            $table->integer('picktime');
            $table->integer('droppoint');
            $table->integer('droptime');
            $table->integer('user_id');
            $table->integer('userrole');
            $table->boolean('user_gender');
            $table->date('entrydate');
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
        Schema::dropIfExists('schedulestudent');
    }
}
