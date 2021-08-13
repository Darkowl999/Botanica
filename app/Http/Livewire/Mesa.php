<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Mesa extends Component
{
    public $mesas;
    public function render()
    {
        $this->mesas=\App\Models\Mesa::all();
        return view('livewire.mesa');

    }
}
