<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gourmets.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole(['admin', 'chef']);

        User::factory(10)->create();
    }
}
