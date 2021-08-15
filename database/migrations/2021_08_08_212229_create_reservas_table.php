<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->integer('cant_personas');
            $table->string('estado');
            //En espera
            //Termianda

            //este es el foreing key
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")
                ->on("users")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger("mesa_id");
            $table->foreign("mesa_id")->references("id")
                ->on("mesas")
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
        Schema::dropIfExists('reservas');
    }
}
