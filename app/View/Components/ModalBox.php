<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $luas;
    public function __construct($luas)
    {
        $this->luas = $luas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-box');
    }
}
