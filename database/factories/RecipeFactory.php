<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {        
        $images = [
            'public/img/recipes/atun.jpg',
            'public/img/recipes/ensalada-cesar.jpg',
            'public/img/recipes/ensalada-simple.jpg',
            'public/img/recipes/lasana-carne-queso.jpg',
            'public/img/recipes/lasana-carne.jpg',
            'public/img/recipes/paella.jpg',
            'public/img/recipes/pan.jpg',
            'public/img/recipes/pescado-plancha-t.jpg',
            'public/img/recipes/solomillo-en-cinco-especias.jpg',
            'public/img/recipes/spaghetti-queso.jpg',
            'public/img/recipes/tostada-guacamole.jpg',
        ];

        return [
            'name' => $this->faker->text(rand(35, 70)),
            'slug' => $this->faker->slug,
            'extract' =>  $this->faker->text(rand(120, 155)),
            'body' =>  $this->faker->text(rand(1200, 1850)),
            'image' => Arr::random($images),//$this->faker->image('public/storage/images/recipes', 640, 480, null, false),
            'meal_id' => Meal::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
