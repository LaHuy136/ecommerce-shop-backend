<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FacadesFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $files;

        if (!$files) {
            $path = storage_path('app/public/products/full');
            $files = collect(FacadesFile::files($path))
                ->map(fn($file) => $file->getFilename())
                ->values();
        }
        return [
            'image' => $files->random(),
        ];
    }
}
