<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::create([
            'nombre'=>'Mañana',
            'hora_llegada'=>'08:00:00',
            'hora_salida'=>'12:00:00'
        ]);
        Turno::create([
            'nombre'=>'Tarde',
            'hora_llegada'=>'12:00:00',
            'hora_salida'=>'18:00:00'
        ]);
        Turno::create([
            'nombre'=>'Noche',
            'hora_llegada'=>'18:00:00',
            'hora_salida'=>'24:00:00'
        ]);
    }
}
