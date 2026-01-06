<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $guarded = [];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>
            mb_convert_case($value, MB_CASE_TITLE, 'UTF-8')
        );
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
