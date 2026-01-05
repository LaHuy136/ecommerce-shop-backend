<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
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
        $countries = Country::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'level' => 1,
            'country_id' => $countries->random()->id,
        ]);

        $users = User::factory(10)->create([
            'level' => 0
        ]);

        Blog::factory(10)->create([
            'user_id' => $admin->id
        ]);

        // Comment::factory(20)->create([
        //     'user_id' =>
        // ]);
    }
}
