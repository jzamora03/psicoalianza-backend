<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToPaisIdInEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            // Se asume que la columna pais_id ya existe en la tabla.
            $table->foreign('pais_id')
                  ->references('id')
                  ->on('paises')
                  ->onDelete('cascade'); // Puedes cambiar la acción de eliminación según tus necesidades.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['pais_id']);
        });
    }
}
