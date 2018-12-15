<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReadAtToAdminMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_messages', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });

        Schema::table('admin_messages', function (Blueprint $table) {
            $table->string('read_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_messages', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });
    }
}
