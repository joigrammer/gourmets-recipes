<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RecipeScheduleTest extends Component
{
    public $recipe;
    public $ration;

    public function render()
    {
        return view('livewire.recipe-schedule', [
            'recipe' => $this->recipe,
            'ration' => $this->ration
        ]);
    }
}
