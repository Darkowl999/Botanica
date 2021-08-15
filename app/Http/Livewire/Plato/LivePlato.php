<?php

namespace App\Http\Livewire\Plato;

use App\Models\Plato;
use Livewire\Component;

class LivePlato extends Component
{
    public $platos;
    public function render()
    {
        $this->platos=Plato::all();
        return view('livewire.plato.live-plato');
    }
}
