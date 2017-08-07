<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('type',['member','admin','school','parents','teacher'])->default('member');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('school_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('school_id')->references('id')->on('users');
            $table->foreign('child_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('parent_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('parent_child');
        Schema::drop('school_child');
        Schema::drop('users');
    }
}
