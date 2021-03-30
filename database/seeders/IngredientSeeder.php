<?php

namespace Database\Seeders;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::factory(50)->create()->each(function ($ingredient){
            $ingredient->allergens()->saveMany(
                Allergen::inRandomOrder()->limit(rand(0,3))->get()
            );
        });
    }
}
