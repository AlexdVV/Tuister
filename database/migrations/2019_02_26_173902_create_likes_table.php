<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->nullable();
            $table->unsignedInteger('coment_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('post_id')
              ->references('id')
              ->on('posts')->onDelete('cascade')
              ->onUpdate('cascade');
            $table->foreign('coment_id')
              ->references('id')
              ->on('coments')->onDelete('cascade')
              ->onUpdate('cascade');
              $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('likes');
    }
}
