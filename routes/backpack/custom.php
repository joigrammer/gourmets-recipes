<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    Route::crud('ingredient', 'IngredientCrudController');
    Route::crud('recipe', 'RecipeCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('meal', 'MealCrudController');
    Route::crud('ration', 'RationCrudController');
    Route::crud('ration/{year}/{month}/{day}/{slug}', 'ReservationCrudController');
    Route::patch('ration/{year}/{month}/{day}/{slug}/{id}/approve', 'ReservationCrudController@approve');
    Route::patch('ration/{year}/{month}/{day}/{slug}/{id}/disapprove', 'ReservationCrudController@disapprove');
    Route::crud('measurement', 'MeasurementCrudController');
}); // this should be the absolute last line of this file
