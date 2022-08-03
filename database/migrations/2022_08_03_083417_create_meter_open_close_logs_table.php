<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_open_close_logs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->tinyInteger('meter_id');
            $table->tinyInteger('switch'); //0 close, 1 open
            $table->tinyInteger('status'); //0 timed out, 1 executed
            $table->string('requested_at');
            $table->string('action_at');
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
        Schema::dropIfExists('meter_open_close_logs');
    }
};
