<?php

namespace App\Http\Livewire\Bitacora;

use App\Models\Bitacora;
use Livewire\Component;

class LiveBitacora extends Component
{
    public $bitacoras;
    public function render()
    {
        $this->bitacoras=Bitacora::all();
        return view('livewire.bitacora.live-bitacora');
    }
}
