<?php

namespace App\Http\Livewire\User;

use App\Models\Bitacora;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveUser extends Component
{
    public $users;
    public $user_actual;

    public $modal;
    public $editar;
    public $crear;
    public $eliminar;

    public $name;
    public $email;
    public $password;
    public $direccion;
    public $estado;
    public $telefono;
    public $rol;



    public function render()
    {
            $this->users=User::all();
        return view('livewire.user.live-user');
    }

    public function crear()
    {
        try {
            if ($this->crear) {
                User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' =>  $this->password,
                    'direccion' => $this->direccion,
                    'estado' => $this->estado,
                    'telefono' => $this->telefono,
                    'rol' => $this->rol,
                ]);
                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Creó un usuario',
                    'user_id'=>Auth::user()->id
                ]);
            } else {
                $this->user_actual->name=$this->name;
                $this->user_actual->email=$this->email;
                $this->user_actual->direccion=$this->direccion;
                $this->user_actual->estado=$this->estado;
                $this->user_actual->telefono=$this->telefono;
                $this->user_actual->rol=$this->rol;
                $this->user_actual->save();

                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Modificó un usuario',
                    'user_id'=>Auth::user()->id
                ]);
            }
        } catch (\Exception $e) {

        }
    }

    public function modal($user_id)
    {
        $this->modal = true;
        $this->crear = $user_id == 0;
        $this->editar = $user_id != 0;;
        if ($this->editar) {
            $this->user_actual = User::find($user_id);

            $this->name=$this->user_actual->name;
            $this->email=$this->user_actual->email;
            $this->direccion=$this->user_actual->direccion;
            $this->estado=$this->user_actual->estado;
            $this->telefono=$this->user_actual->telefono;
            $this->rol=$this->user_actual->rol;

        }else{
            $this->reset([
                'name',
                'email',
                'password',
                'direccion',
                'estado',
                'telefono',
                'rol'
            ]);
        }

    }
    public function eliminar($user_id){
        $this->user_actual = User::find($user_id);
        $this->eliminar=true;
    }
    public function eliminarUser(){
        $this->user_actual->delete();
        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Eliminó un usuario',
            'user_id'=>Auth::user()->id
        ]);
        $this->eliminar=false;
    }











}
