<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('busid')->unique();
            $table->string('registration')->unique();
            $table->string('license')->unique();
            $table->integer('seat');
            $table->boolean('availability')->default(true);
            $table->integer('user_id');
            $table->string('insurance_no');
            $table->date('insurance_validity');
            $table->string('route_permit');
            $table->date('route_permit_validity');
            $table->integer('bustype');
            $table->string('bus_name');
            $table->string('busowner');
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('businfo');
    }
}
