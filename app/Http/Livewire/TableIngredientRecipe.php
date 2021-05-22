<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableIngredientRecipe extends Component
{
    public $ingredients;
    public $allergens;

    public function render()
    {
        return view('livewire.table-ingredient-recipe', [
            'ingredients' => $this->ingredients,
            'allergens'   => $this->allergens
        ]);
    }
}
