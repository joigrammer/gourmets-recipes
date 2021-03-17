<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Allergen;
use Illuminate\Support\Str;

class AllergenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Allergen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(rand(1, 3));
        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
