<?php

namespace App\Http\Livewire\Plato;

use App\Models\Bitacora;
use App\Models\Plato;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LivePlato extends Component
{
    public $platos;
    public $plato_actual;

    public $modal;
    public $editar;
    public $crear;
    public $eliminar;

    public $nombre;
    public $descripcion;
    public $precio;
    public $estado;
    public $cantidad;

    public function render()
    {
        $this->platos=Plato::all();
        return view('livewire.plato.live-plato');
    }

    public function crear()
    {
        try {
            if ($this->crear) {
                Plato::create([
                    'nombre' => $this->nombre,
                    'descripcion' => $this->descripcion,
                    'precio' =>  $this->precio,
                    'estado' => 'Disponible',
                    'cantidad' => $this->cantidad,
                ]);
                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Creó un plato',
                    'user_id'=>Auth::user()->id
                ]);

            } else {
                $this->plato_actual->nombre=$this->nombre;
                $this->plato_actual->descripcion=$this->descripcion;
                $this->plato_actual->precio = $this->precio;
                $this->plato_actual->estado=$this->estado;
                $this->plato_actual->cantidad=$this->cantidad;
                $this->plato_actual->save();

                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Modificó un plato',
                    'user_id'=>Auth::user()->id
                ]);

            }
        } catch (\Exception $e) {

        }
    }

    public function modal($plato_id)
    {
        $this->modal = true;
        $this->crear = $plato_id == 0;
        $this->editar = $plato_id != 0;;
        if ($this->editar) {
            $this->plato_actual = Plato::find($plato_id);

            $this->nombre=$this->plato_actual->nombre;
            $this->descripcion=$this->plato_actual->descripcion;
            $this->precio = $this->plato_actual->precio;
            $this->estado=$this->plato_actual->estado;
            $this->cantidad=$this->plato_actual->cantidad;
        }else{
            $this->reset([
                'nombre',
                'descripcion',
                'precio',
                'estado',
                'cantidad'
            ]);
        }

    }
    public function eliminar($plato_id){
        $this->plato_actual = Plato::find($plato_id);
        $this->eliminar=true;
    }
    public function elimiarPlato(){
        $this->plato_actual->delete();
        $this->eliminar=false;

        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Eliminó un plato',
            'user_id'=>Auth::user()->id
        ]);
    }
}
