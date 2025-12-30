<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(10)->create();

        Blog::factory(10)->create();


        User::factory()
            ->create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password')
            ]);
    }
}
