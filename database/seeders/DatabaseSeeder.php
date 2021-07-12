<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email' => 'corinaneina02@gmail.com',
            'name' => 'Nina Corina',
            'password' => \bcrypt('admin'),
            'role' => 'admin'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}