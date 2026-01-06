<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Product;
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

        $categories = Category::factory(10)->create();

        $brands = Brand::factory(10)->create();

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

        // $products = Product::factory(20)->create([
        //     'user_id'     => $users->random()->id,
        //     'category_id' => $categories->random()->id,
        //     'brand_id'    => $brands->random()->id,
        // ]);


        // Blog::factory(10)->create([
        //     'user_id' => $admin->id
        // ]);
    }
}
