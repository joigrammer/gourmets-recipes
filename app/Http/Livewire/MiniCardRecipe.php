<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MiniCardRecipe extends Component
{
    public $recipe;

    public function render()
    {
        return view('livewire.mini-card-recipe', $this->recipe);
    }
}
