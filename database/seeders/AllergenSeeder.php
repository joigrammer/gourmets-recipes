<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Gluten',
                'slug' => 'gluten',
                'icon' => 'public/icons/allergens/gluten.svg'
            ],
            [
                'name' => 'Peanuts',
                'slug' => 'peanuts',
                'icon' => 'public/icons/allergens/peanuts.svg'
            ],
            [
                'name' => 'Tree Nuts',
                'slug' => 'tree-nuts',
                'icon' => 'public/icons/allergens/tree-nuts.svg'
            ],
            [
                'name' => 'Celery',
                'slug' => 'celery',
                'icon' => 'public/icons/allergens/celery.svg'
            ],
            [
                'name' => 'Mustard',
                'slug' => 'mustard',
                'icon' => 'public/icons/allergens/mustard.svg'
            ],
            [
                'name' => 'Eggs',
                'slug' => 'eggs',
                'icon' => 'public/icons/allergens/eggs.svg'
            ],
            [
                'name' => 'Milk',
                'slug' => 'milk',
                'icon' => 'public/icons/allergens/milk.svg'
            ],
            [
                'name' => 'Sesame',
                'slug' => 'sesame',
                'icon' => 'public/icons/allergens/sesame.svg'
            ],
            [
                'name' => 'Fish',
                'slug' => 'fish',
                'icon' => 'public/icons/allergens/fish.svg'
            ],
            [
                'name' => 'Crustaceans',
                'slug' => 'crustaceans',
                'icon' => 'public/icons/allergens/crustaceans.svg'
            ],
            [
                'name' => 'Molluscs',
                'slug' => 'molluscs',
                'icon' => 'public/icons/allergens/molluscs.svg'
            ],
            [
                'name' => 'Soya',
                'slug' => 'soya',
                'icon' => 'public/icons/allergens/soya.svg'
            ],
            [
                'name' => 'Sulphites',
                'slug' => 'sulphites',
                'icon' => 'public/icons/allergens/sulphites.svg'
            ],
            [
                'name' => 'Lupin',
                'slug' => 'lupin',
                'icon' => 'public/icons/allergens/lupin.svg'
            ],
        ];
        Allergen::insert($data);
    }
}
