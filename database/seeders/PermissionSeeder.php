<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $categories = Permission::create(['name' => 'view-categories']);
        $ingredients = Permission::create(['name' => 'view-ingredients']);
        $meals = Permission::create(['name' => 'view-meals']);
        $measurements = Permission::create(['name' => 'view-measurements']);
        $rations = Permission::create(['name' => 'view-rations']);
        $recipes = Permission::create(['name' => 'view-recipes']);
        $tags = Permission::create(['name' => 'view-tags']);

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo([
           $categories, $rations, $tags
        ]);

        $chef = Role::where('name', 'chef')->first();
        $chef->givePermissionTo([
            $ingredients, $meals, $measurements, $recipes
        ]);
    }
}
