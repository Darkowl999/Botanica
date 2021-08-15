<?php

namespace Database\Seeders;

use App\Models\Mesa;
use Illuminate\Database\Seeder;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mesa::create([
            'capacidad'=>4,
            'estado'=>'Libre',
            'area_id'=>2
        ]);
        Mesa::create([
            'capacidad'=>4,
            'estado'=>'Libre',
            'area_id'=>1
        ]);
        Mesa::create([
            'capacidad'=>4,
            'estado'=>'Ocupado',
            'area_id'=>2
        ]);
        Mesa::create([
            'capacidad'=>4,
            'estado'=>'Libre',
            'area_id'=>1
        ]);

    }
}
