<?php

namespace App\Http\Livewire\Pedido;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\PedidoPlato;
use App\Models\Plato;
use App\Models\User;
use Livewire\Component;

class LivePedido extends Component
{
    public $pedidos;
    public $platos;
    public $clientes;
    public $mesas;
    public $pedido_actual;

    public $modal;
    public $editar;
    public $crear;
    public $eliminar;
    public $agregar;

    public $activo;
    public $user_id;
    public $mesa_id;
    public $cantidad;
    public $plato_id;
    public $platos_pedidos;

    public function mount()
    {
        $this->platos_pedidos = collect([]);
    }


    public function render()
    {
        $this->pedidos = Pedido::with('platos')->with('pplatos')->get();
        $this->platos = Plato::where('cantidad', '>', 0)->get();
        $this->clientes = User::where('rol', '0,0,3')->get();
        $this->mesas = Mesa::all();
        return view('livewire.pedido.live-pedido');
    }

    public function crear()
    {
        $this->user_id = $this->user_id == null ? $this->clientes[0]->id : $this->user_id;
        $this->mesa_id = $this->mesa_id == null ? $this->mesas[0]->id : $this->mesa_id;

        try {
            if ($this->crear) {
                $ped = Pedido::create([
                    'activo' => true,
                    'user_id' => $this->user_id,
                    'mesa_id' => $this->mesa_id,
                ]);

                $mesa = Mesa::find($this->mesa_id);
                $mesa->estado = 'Ocupado';
                $mesa->save();

                foreach ($this->platos_pedidos as $p) {


                    PedidoPlato::create([
                        'cantidad' => $p['cantidad'],
                        'pedido_id' => $ped->id,
                        'plato_id' => $p['id']
                    ]);

                    $plat = Plato::find($p['id']);
                    $plat->cantidad = $plat->cantidad - $p['cantidad'];
                    $plat->save();
                }

            } else {
                $mesa = Mesa::find($this->pedido_actual->mesa_id);
                $mesa->estado = 'Libre';
                $mesa->save();

                $this->pedido_actual->activo = $this->activo;
                $this->pedido_actual->user_id = $this->user_id;
                $this->pedido_actual->mesa_id = $this->mesa_id;
                $this->pedido_actual->save();

                foreach ($this->platos_pedidos as $key => $p) {
                    $temp = $this->platos_pedidos[$key];
                    $pp = PedidoPlato::where('pedido_id', $this->pedido_actual->id)
                        ->where('plato_id', $temp['id'])
                        ->first();
                    if ($pp != null) {
                        $p = Plato::find($temp['id']);
                        $p->cantidad = $p->cantidad + $pp->cantidad;
                        $p->save();
                        $pp->delete();
                    }
                }


                foreach ($this->platos_pedidos as $p) {
                    PedidoPlato::create([
                        'cantidad' => $p['cantidad'],
                        'pedido_id' => $this->pedido_actual->id,
                        'plato_id' => $p['id']
                    ]);
                    $plat = Plato::find($p['id']);
                    $plat->cantidad = $plat->cantidad - $p['cantidad'];
                    $plat->save();
                }
                $mesa = Mesa::find($this->pedido_actual->mesa_id);
                $mesa->estado = 'Ocupado';
                $mesa->save();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function modal($pedido_id)
    {
        $this->platos_pedidos = collect([]);
        $this->modal = true;
        $this->crear = $pedido_id == 0;
        $this->editar = $pedido_id > 0;;
        if ($this->editar) {
            $this->pedido_actual = Pedido::with('platos')->with('pplatos')->find($pedido_id);
            $this->activo = $this->pedido_actual->activo;
            $this->user_id = $this->pedido_actual->user_id;
            $this->mesa_id = $this->pedido_actual->mesa_id;

            foreach ($this->pedido_actual->platos as $key => $p) {
                $pp = $this->pedido_actual->pplatos[$key];
                $this->platos_pedidos->push(['id' => $p->id, 'cantidad' => $pp->cantidad, 'plato' => $p]);
            }
        } else {
            $this->reset([
                'activo',
                'user_id',
                'mesa_id',
                'cantidad',

            ]);
            $this->platos_pedidos = collect([]);
        }


    }


    public function elimiarPedido()
    {
        foreach ($this->platos_pedidos as $key => $p) {
            $this->quitarPlato($key);
        }
        $mesa = Mesa::find($this->pedido_actual->mesa_id);
        $mesa->estado = 'Libre';
        $mesa->save();

        $this->pedido_actual->delete();
        $this->eliminar = false;
    }

    public function agregar()
    {
        $this->plato_id = $this->plato_id == null ? $this->platos[0]->id : $this->plato_id;
        foreach ($this->platos_pedidos as $key => $p) {
            if ($p['id'] == $this->plato_id) {
                $this->platos_pedidos->forget($key);
                $this->platos_pedidos->push(['id' => $this->plato_id, 'cantidad' => $this->cantidad + $p['cantidad'], 'plato' => Plato::find($this->plato_id)]);
                $this->reset(['cantidad', 'plato_id']);
                return;
            }
        }
        $this->platos_pedidos->push(['id' => $this->plato_id, 'cantidad' => $this->cantidad, 'plato' => Plato::find($this->plato_id)]);
        $this->reset(['cantidad', 'plato_id']);
    }

    public function quitarPlato($key)
    {
        if ($this->editar) {
            $temp = $this->platos_pedidos[$key];
            $pp = PedidoPlato::where('pedido_id', $this->pedido_actual->id)
                ->where('plato_id', $temp['id'])
                ->first();
            $p = Plato::find($temp['id']);
            $p->cantidad = $p->cantidad + $pp->cantidad;
            $p->save();
            $pp->delete();
        }
        $this->platos_pedidos->forget($key);
    }

    public function cerrar(){
        $mesa = Mesa::find($this->pedido_actual->mesa_id);
        $mesa->estado = 'Libre';
        $mesa->save();

        $this->pedido_actual->activo=false;
        $this->pedido_actual->save();
    }
}
