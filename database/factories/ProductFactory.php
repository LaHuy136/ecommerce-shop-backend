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
        $condition = fake()->randomElement(['new', 'sale']);
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'price' => fake()->numberBetween(100, 1000),
            'condition' => $condition,
            'sale_percent' => $condition === 'sale'
                ? fake()->numberBetween(5, 50)
                : null,
            'company'     => fake()->company(),
            'status'      => 'available',
            'description' => fake()->sentence(),
        ];
    }
}
