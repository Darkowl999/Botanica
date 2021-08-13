<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'juan',
            'email'=>'juan@gmail.com',
            'password'=>Hash::make('password'),
            'direccion'=>'av los palotes',
            'estado'=>true,
            'telefono'=>65203120,
            'rol'=>'1,0,0'
        ]);

    }
}
