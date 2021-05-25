<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RationController;
use App\Http\Controllers\RecipePageController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\EnsureRationDateIsValid;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index'])->name('welcome');

Route::prefix('recipes')->group(function () {
    Route::get('/', [RecipePageController::class, 'index'])->name('dashboard');

    Route::get('/{slug}', [RecipePageController::class, 'show'])->name('recipes.show');
    Route::get('/meals/{slug}', [RecipePageController::class, 'meals'])->name('recipes.meals');
});

Route::prefix('rations')->group(function () {
    Route::get('/', [RationController::class, 'index'])->name('rations.schedule');
    Route::get('/{year}/{month}/{day}/{slug}', [RationController::class, 'create'])
        ->name('rations.create')
        ->middleware(EnsureRationDateIsValid::class);
    Route::post('/reserve', [RationController::class, 'store'])->name('rations.store')->middleware('auth');
});

Route::get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');

Route::get('/reservations/{slug}', [ReservationController::class, 'index'])->name('reservations.index');

//Route::middleware(['auth:sanctum', 'verified'])->get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');
