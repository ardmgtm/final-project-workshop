<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Category;
use App\Domains\Products\Models\Product;

class CreateProductAction
{
    public function execute(Category $category, string $name, string $description, float $price): Product
    {
        return Product::create([
            'category_id' => $category->id,
            'name' => $name,
            'description' => $description,
            'price' => $price
        ]);
    }
}
