<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
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
                'name' => 'Pescados y maríscos',
                'slug' => 'pescados-y-mariscos',
                'description' => '',
                'image' => 'public/icons/meals/fish.svg'
            ],
            [
                'name' => 'Carnes rojas',
                'slug' => 'carnes-rojas',
                'description' => '',
                'image' => 'public/icons/meals/meat.svg'
            ],
            [
                'name' => 'Postres y dulces',
                'slug' => 'postres-dulces',
                'description' => '',
                'image' => 'public/icons/meals/cupcake.svg'
            ],
            [
                'name' => 'Carnes u otras aves',
                'slug' => 'carnes-u-otras-aves',
                'description' => '',
                'image' => 'public/icons/meals/chicken.svg'
            ],
            [
                'name' => 'Panes y masas',
                'slug' => 'panes-y-masas',
                'description' => '',
                'image' => 'public/icons/meals/grano.svg'
            ],
            [
                'name' => 'Ensaladas',
                'slug' => 'ensaladas',
                'description' => '',
                'image' => 'public/icons/meals/ensalada.svg'
            ]
        ];
        Meal::insert($data);
    }
}
