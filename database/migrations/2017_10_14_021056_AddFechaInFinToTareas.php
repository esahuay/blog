<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaInFinToTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->datetime('fecha_inic');
            $table->datetime('fecha_fin')->nullable();
            $table->boolean('todoeldia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropColumn('fecha_inic');
            $table->dropColumn('fecha_fin')->nullable();
            $table->dropColumn('todoeldia')->nullable();
        });
    }
}
