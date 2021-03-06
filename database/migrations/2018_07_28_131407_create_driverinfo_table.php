<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driverinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nid')->unique();
            $table->string('driverid')->unique();
            $table->string('licensepic')->nullable();
            $table->string('license')->unique();
            $table->integer('experience')->default(0);
            $table->string('contactno')->unique();
            $table->string('busno');
            $table->mediumText('address');
            $table->boolean('gender')->default(false)->nullable();
            $table->string('image')->nullable()->default('defaultAdmin.png');
            $table->date('join_date');
            $table->boolean('active')->default(false)->nullable();
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
        Schema::dropIfExists('driverinfo');
    }
}
