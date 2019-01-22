<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRUserAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_user_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id');
            $table->string('wechat_nickname');
            $table->integer('awards_id');
            $table->string('awards_name');
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
        Schema::dropIfExists('r_user_awards');
    }
}
