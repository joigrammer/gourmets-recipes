<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RecipeSchedule extends Component
{
    public $recipe;

    public function render()
    {
        return view('livewire.recipe-schedule', [
            'recipe' => $this->recipe
        ]);
    }
}
