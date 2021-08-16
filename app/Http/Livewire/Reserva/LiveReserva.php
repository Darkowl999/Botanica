<?php

namespace App\Http\Livewire\Reserva;

use App\Models\Bitacora;
use App\Models\Mesa;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveReserva extends Component
{
    public $mesas_disponibles;
    public $reservas;
    public $reserva_actual;

    public $modal;
    public $editar;
    public $crear;
    public $eliminar;

    public $fecha;
    public $hora;
    public $cant_personas;
    public $mesa_id;
    public $estado;


    public function render()
    {
        $user = Auth::user();
        $roles = explode(',', $user->rol);
        if ($roles[2] == '0' && $roles[2] == '0') {
            $this->reservas = Reserva::where('user_id', $user->id)
                ->get();
        } else {
            $this->reservas = Reserva::all();
        }
        $this->mesas_disponibles = Mesa::where('Estado', 'Libre')->get();
        return view('livewire.reserva.live-reserva');
    }
    public function reservar()
    {
        try {
            $this->mesa_id = $this->mesa_id == null ? $this->mesas_disponibles[0]->id : $this->mesa_id;
            if ($this->crear) {

                $r = Reserva::create([
                    'fecha' => $this->fecha,
                    'hora' => $this->hora,
                    'cant_personas' => $this->cant_personas,
                    'estado' => 'En espera',
                    'user_id' => Auth::user()->id,
                    'mesa_id' => $this->mesa_id
                ]);

                $mesa = Mesa::find($this->mesa_id);
                $mesa->estado = 'Reservado';
                $mesa->save();

                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Creó una reserva',
                    'user_id'=>Auth::user()->id
                ]);

            } else {
                $mesa = Mesa::find($this->reserva_actual->mesa_id);
                $mesa->estado = 'Libre';
                $mesa->save();

                $this->reserva_actual->fecha = $this->fecha;
                $this->reserva_actual->hora = $this->hora;
                $this->reserva_actual->cant_personas = $this->cant_personas;
                $this->reserva_actual->estado = $this->estado;
                $this->reserva_actual->user_id = Auth::user()->id;
                $this->reserva_actual->mesa_id = $this->mesa_id;
                $this->reserva_actual->save();

                Bitacora::create([
                    'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
                    'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
                    'accion'=>'Modificó una reserva',
                    'user_id'=>Auth::user()->id
                ]);

                $mesa = Mesa::find($this->mesa_id);
                $mesa->estado = $this->estado=='Concluida'?'Ocupado':'Reservado';
                $mesa->save();
            }
        } catch (\Exception $e) {
        }
    }

    public function modal($reserva_id)
    {
        $this->modal = true;
        $this->crear = $reserva_id == 0;
        $this->editar = $reserva_id != 0;;
        if ($this->editar) {
            $this->reserva_actual = Reserva::find($reserva_id);

            $this->fecha=$this->reserva_actual->fecha;
            $this->hora=$this->reserva_actual->hora;
            $this->estado = $this->reserva_actual->estado;
            $this->cant_personas=$this->reserva_actual->cant_personas;
            $this->mesa_id=$this->reserva_actual->mesa_id;
        }

    }
    public function eliminar($reserva_id){
        $this->reserva_actual = Reserva::find($reserva_id);
        $this->eliminar=true;
    }
    public function elimiarReserva(){
        $mesa = Mesa::find($this->reserva_actual->mesa_id);
        $mesa->estado = 'Libre';
        $mesa->save();

        $this->reserva_actual->delete();

        Bitacora::create([
            'fecha'=>Carbon::now('America/La_Paz')->toDateString(),
            'hora'=>Carbon::now('America/La_Paz')->toTimeString(),
            'accion'=>'Eliminó una reserva',
            'user_id'=>Auth::user()->id
        ]);

        $this->eliminar=false;
    }

}
