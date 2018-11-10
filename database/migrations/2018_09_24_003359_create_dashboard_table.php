<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->boolean('special_schedule')->default(0);
            $table->boolean('regular_schedule')->default(0);
            $table->boolean('holiday')->default(0);
            $table->boolean('schedule_suspend')->default(0);
            $table->boolean('schedule_edit')->default(0);
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
