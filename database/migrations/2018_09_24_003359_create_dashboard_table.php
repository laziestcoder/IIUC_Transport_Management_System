<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('special_schedule')->default(0)->nullable();
            $table->boolean('regular_schedule')->default(0)->nullable();
            $table->boolean('holiday')->default(0)->nullable();
            $table->boolean('schedule_suspend')->default(0)->nullable();
            $table->boolean('schedule_edit')->default(0)->nullable();
            $table->integer('editdate')->default(45);
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
        Schema::dropIfExists('dashboard');
    }
}
