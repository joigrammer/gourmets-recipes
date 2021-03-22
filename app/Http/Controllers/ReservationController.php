<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        return view('reservations.index', compact('recipe'));
    }
}
