<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            //este es el foreing key
            $table->boolean("activo");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")
                ->on("users")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            //forrane para mesa
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
        Schema::dropIfExists('pedidos');
    }
}
