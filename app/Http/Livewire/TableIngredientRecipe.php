<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableIngredientRecipe extends Component
{
    public $ingredients;

    public function render()
    {
        return view('livewire.table-ingredient-recipe', $this->ingredients);
    }
}
