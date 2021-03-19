<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardRecipe extends Component
{
    public $recipe;

    public function render()
    {
        return view('livewire.card-recipe', $this->recipe);
    }
}
