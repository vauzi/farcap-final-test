<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Alert extends Component
{
    public $status;
    public $message;
    public function render()
    {
        return view('livewire.component.alert');
    }
}
