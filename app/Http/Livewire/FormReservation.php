<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormReservation extends Component
{
    public $ration;
    public $tickets = 1;

    public function increment()
    {
        $this->tickets++;
    }

    public function descrement()
    {
        if (count($this->tickets) > 1) {
            $this->tickets--;
        }        
    }

    public function render()
    {
        return view('livewire.form-reservation');
    }
}
