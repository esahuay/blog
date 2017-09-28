<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('type',['kinder','high'])->default('kinder');
            $table->rememberToken();
            $table->timestamps();
        });

        // Students & Colleges = article_tag -> user=college
        Schema::create('student_user', function(Blueprint $table){
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('students');
        Schema::drop('student_college');
    }
}
