<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'name' => fake()->name(),
            'price' => fake()->numberBetween(100, 1000),
            'condition'   => fake()->randomElement(['new', 'sale']),
            'sale_percent' => null,
            'company'     => fake()->company(),
            'status'      => 'available',
            'description' => fake()->sentence(),
        ];
    }
}
