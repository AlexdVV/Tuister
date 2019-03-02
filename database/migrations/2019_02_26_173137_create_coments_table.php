<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id');
            $table->foreign('user_id')
              ->references('id')
              ->on('users')->onDelete('cascade')
              ->onUpdate('cascade');
            $table->foreign('post_id')
              ->references('id')
              ->on('posts')->onDelete('cascade')
              ->onUpdate('cascade');
            $table->string('body');
            $table->string('imagen_url')->nullable();

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
        Schema::dropIfExists('coments');
    }
}
