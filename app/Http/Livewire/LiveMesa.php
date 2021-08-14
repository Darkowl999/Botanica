<?php

namespace App\Http\Livewire;

use App\Models\Area;

use App\Models\Mesa;
use Livewire\Component;

class LiveMesa extends Component
{
    public $mesas;
    public $areas;
    public $mesaModal;
    public $mesa;

    public $area_id;
    public $capacidad;


    public function render()
    {
        $this->mesas=Mesa::all();
        $this->areas=Area::all();
        return view('livewire.live-mesa');

    }

public function mesaModal($mesaId){
        $this->mesa=Mesa::find($mesaId);
        $this->area_id=$this->mesa->area_id;
        $this->capacidad=$this->mesa->capacidad;
        $this->mesaModal=true;
}
public function save(){

}
}
