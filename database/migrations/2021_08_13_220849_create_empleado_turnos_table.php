<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_turnos', function (Blueprint $table) {
            $table->id();
            //este es el foreing key
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")
                ->on("users")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            //este es el foreing key
            $table->unsignedBigInteger("turno_id");
            $table->foreign("turno_id")->references("id")
                ->on("turnos")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('empleado_turnos');
    }
}
