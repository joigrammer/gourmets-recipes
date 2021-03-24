<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RationController;
use App\Http\Controllers\RecipePageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index'])->name('welcome');

Route::prefix('recipes')->group(function () {
    Route::get('/', [RecipePageController::class, 'index'])->name('dashboard');

    Route::get('/{slug}', [RecipePageController::class, 'show'])->name('recipes.show');
    Route::get('/meals/{slug}', [RecipePageController::class, 'meals'])->name('recipes.meals');
});

Route::get('/rations', [ RationController::class, 'index'])->name('rations.index');

Route::get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');

Route::get('/reservations/{slug}', [ReservationController::class, 'index'])->name('reservations.index');

//Route::middleware(['auth:sanctum', 'verified'])->get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');
