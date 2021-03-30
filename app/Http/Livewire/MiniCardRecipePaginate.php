<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class MiniCardRecipePaginate extends Component
{
    public $meal;

    public function render()
    {  
        return view('livewire.mini-card-recipe-paginate', [
            'recipes' => Recipe::select('recipes.*')->join('meals', 'recipes.meal_id', '=', 'meals.id')->where(function ($query) {
                if (! empty($this->meal)) {
                    $query->where('meals.slug', $this->meal);
                }                
            })->paginate(12)
        ]);
    }
}
