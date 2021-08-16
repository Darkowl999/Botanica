<?php

namespace App\Http\Livewire\Mesa;

use App\Models\Area;

use App\Models\Bitacora;
use App\Models\Mesa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveMesa extends Component
{
    public $mesas;
    public $areas;

    public $mesa;

    public $mesaModal;
    public $mesaNueva;

    public $area_id;
    public $capacidad;


    public function render()
    {
        $this->mesas = Mesa::all();
        $this->areas = Area::all();
        return view('livewire.mesa.live-mesa');

    }

    public function mesaModal($mesaId)
    {
        $this->mesa = Mesa::find($mesaId);
        $this->area_id = $this->mesa->area_id;
        $this->capacidad = $this->mesa->capacidad;
        $this->mesaModal = true;
    }

    public function editar()
    {
        $this->mesa->capacidad = $this->capacidad;
        $this->mesa->area_id = $this->area_id;
        $this->mesa->save();

        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Modificó una mesa',
            'user_id'=>Auth::user()->id
        ]);

        $this->reset(['capacidad', 'area_id']);
    }

    public function crear()
    {
        Mesa::create([
            'capacidad' => $this->capacidad,
            'estado' => 'Libre',
            'area_id' => $this->area_id == null ? 1 : $this->area_id
        ]);
        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Creó una mesa',
            'user_id'=>Auth::user()->id
        ]);
        $this->reset(['capacidad', 'area_id']);
    }

    public function eliminar()
    {
        $this->mesa->delete();
        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Eliminó una mesa',
            'user_id'=>Auth::user()->id
        ]);
        $this->mesaModal=false;
        $this->reset('mesa');
    }
}
