<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;
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

        \App\Models\Role::create([
            'name' => 'ROLE_SUPERADMIN'
        ]);

        \App\Models\Role::create([
            'name' => 'ROLE_USER'
        ]);

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'secretword' => 'secretword',
            'email_verified_at' => now(),
        ]);


        $roles = Role::where('name', 'ROLE_SUPERADMIN')->get();
        User::all()->each(function($user) use ($roles) {
            $user->roles()->attach($roles);
        });

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'secretword' => 'secretword',
        ]);
    }
}
