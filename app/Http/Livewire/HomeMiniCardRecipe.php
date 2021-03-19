<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeMiniCardRecipe extends Component
{
    public $recipe;

    public function render()
    {
        return view('livewire.home-mini-card-recipe', $this->recipe);
    }
}
