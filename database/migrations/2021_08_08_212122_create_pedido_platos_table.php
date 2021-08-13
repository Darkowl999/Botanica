<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoPlatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_platos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->text('modificacion');

            //este es el foreing key
            $table->unsignedBigInteger("pedido_id");
            $table->foreign("pedido_id")->references("id")
                ->on("pedidos")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            //este es el foreing key para plato
            $table->unsignedBigInteger("plato_id");
            $table->foreign("plato_id")->references("id")
                ->on("platos")
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
        Schema::dropIfExists('pedido_platos');
    }
}
