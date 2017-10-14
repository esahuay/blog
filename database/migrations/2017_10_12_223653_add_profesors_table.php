<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        // profesors & Colleges = article_tag -> user=college
        Schema::create('profesor_user', function(Blueprint $table){
            $table->increments('id');
            $table->integer('profesor_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Students & salones (tags)
        Schema::create('profesor_tag', function(Blueprint $table){
            $table->increments('id');
            $table->integer('profesor_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::drop('profesor_user');
        Schema::drop('profesors');
    }
}
