<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            MealSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            AllergenSeeder::class,
            IngredientSeeder::class,
            RecipeSeeder::class,
            MeasurementSeeder::class,
        ]);
    }
}
