<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Nike',
                'Adidas',
                'Zara',
                'Under Armour',
                'Gucci',
                'Louis Vuitton',
                'Asics',
                'Puma',
                'Mizuno',
                'Head',
            ])
        ];
    }
}
