<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullcalendareventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullcalendarevents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('titulo');
            $table->datetime('fecha_inic');
            $table->datetime('fecha_fin')->nullable();
            $table->datetime('todoeldia')->nullable();
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
        Schema::drop('fullcalendarevents');
    }
}
