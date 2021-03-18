<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;

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
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'extract' =>  $this->faker->text(rand(32, 155)),
            'body' =>  $this->faker->text(rand(200, 450)),
            'meal_id' => Meal::all()->random()->id
        ];
    }
}
