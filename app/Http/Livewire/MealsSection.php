<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;

class MealsSection extends Component
{
    public function render()
    {
        $meals = Meal::all();
        return view('livewire.meals-section', compact('meals'));
    }
}
