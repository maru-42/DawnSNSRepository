<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            // 詳細設計書p9に従ってfollow_idに変更した
            //$table->integer('follow');
            $table->integer('follow_id');
            // 詳細設計書p9に従ってfollower_idに変更した
            //$table->integer('follower');
            $table->integer('follower_id');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}