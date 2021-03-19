<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $total = Recipe::all()->count();
        $recipes = Recipe::limit(12)->get();
        return view('welcome', compact('recipes', 'total'));
    }
}
