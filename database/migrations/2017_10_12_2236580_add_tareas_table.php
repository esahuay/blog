<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('profesor_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');            
            $table->timestamps();
        });

        // Articles & Tags = article_tag
        Schema::create('tag_tarea', function(Blueprint $table){
            $table->increments('id');
            $table->integer('tarea_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
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
        Schema::drop('tarea_tag');
        Schema::drop('tareas');
    }
}
