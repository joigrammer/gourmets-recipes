<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RationController extends Controller
{
    public function index()
    {
        return view('rations.index');
    }

    public function create($year, $month, $day, $slug)
    {
        $date = Carbon::create($year, $month, $day);
        dd($date);
        $recipe = Recipe::where('slug', $slug)->first();
        return view('rations.create', compact('recipe'));
    }
}
