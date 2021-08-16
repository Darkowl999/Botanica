<?php

namespace App\Http\Livewire\Recibo;

use App\Models\Pedido;
use Livewire\Component;

class LiveRecibo extends Component
{
    public $recibos;
    public $recibo_actual;
    public $ver;
    public function render()
    {
        $this->recibos = Pedido::with('platos')->with('pplatos')->get();
        return view('livewire.recibo.live-recibo');
    }

    public function verPlatos($recibo_id)
    {
        $this->recibo_actual = Pedido::with('platos')->with('pplatos')->get();
        $this->ver=true;
    }

}
