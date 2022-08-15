<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'secretword' => 'secretword',
        ]);

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'secretword' => 'secretword',
        ]);
    }
}
