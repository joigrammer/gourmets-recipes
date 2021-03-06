<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::factory(50)->create()->each(function ($recipe){
            $recipe->tags()->saveMany(
                Tag::inRandomOrder()->limit(rand(0,3))->get()
            );
            /*$recipe->ingredients()->saveMany(
                Ingredient::inRandomOrder()->limit(rand(2, 8))->get()
            );*/
        });
    }
}
