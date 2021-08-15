<?php

namespace Database\Seeders;

use App\Models\Plato;
use Illuminate\Database\Seeder;

class PlatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plato::create([
            'nombre'=>'Pollo',
            'descripcion'=>'Pollo con mostaza',
            'precio'=>13,
            'estado'=>'Disponible',
            'cantidad'=>20
        ]);

        Plato::create([
            'nombre'=>'Pato',
            'descripcion'=>'Pato con mostaza',
            'precio'=>13,
            'estado'=>'Disponible',
            'cantidad'=>20
        ]);
        Plato::create([
            'nombre'=>'Cerdo',
            'descripcion'=>'Cerdo con mostaza',
            'precio'=>13,
            'estado'=>'Disponible',
            'cantidad'=>20
        ]);

        Plato::create([
            'nombre'=>'Vaca',
            'descripcion'=>'Vaca con mostaza',
            'precio'=>13,
            'estado'=>'Disponible',
            'cantidad'=>20
        ]);


    }
}
