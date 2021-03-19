<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RecipePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomePageController::class, 'index'])->name('welcome');

Route::get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');

//Route::middleware(['auth:sanctum', 'verified'])->get('/recipes', [RecipePageController::class, 'index'])->name('dashboard');
