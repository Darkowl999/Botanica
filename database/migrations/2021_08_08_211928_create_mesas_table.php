<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->integer('capacidad');
            $table->string('estado');


            //este es el foreing key
            $table->unsignedBigInteger("area_id");
            $table->foreign("area_id")->references("id")
                ->on("areas")
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
        Schema::dropIfExists('mesas');
    }
}
