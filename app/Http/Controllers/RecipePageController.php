<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipePageController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('dashboard', compact('recipes'));
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        return view('recipes.show', compact('recipe'));
    }

    public function meals($slug)
    {
        $meal = Meal::where('slug', $slug)->first();
        return view('recipes.meals', compact('meal'));
    }
}
