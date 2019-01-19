<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRWechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_wechats', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('subscribe');
            $table->string('openid');
            $table->string('nickname');
            $table->tinyInteger('sex');
            $table->string('city');
            $table->string('country');
            $table->string('province');
            $table->string('headimgurl');
            $table->string('subscribe_time');
            $table->string('subscribe_end_time')->useCurrent();
            $table->string('remark');
            $table->string('subscribe_scene');
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
        Schema::dropIfExists('r_wechats');
    }
}
