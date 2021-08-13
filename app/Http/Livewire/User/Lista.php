<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Lista extends Component
{
    public $users;

    public function render()
    {
            $this->users=User::all();
        return view('livewire.user.lista');
    }

    //con esto se elimina
    public function eliminar($id){
        $user=User::destroy($id);
    }
    public function actualizar($id){
        $user=User::find($id);
        $user->name='pedro';
        $user->save();
    }









}
