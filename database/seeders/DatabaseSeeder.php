<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductImage;
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

        $categories = Category::factory(11)->create();

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

        // $products = Product::factory(20)->create();

        // $products->each(function ($product) {
        //     ProductImage::factory(rand(3, 5))->create([
        //         'product_id' => $product->id,
        //     ]);
        // });

        Blog::factory(10)->create([
            'user_id' => $admin->id
        ]);
    }
}
