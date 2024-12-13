<?php

namespace Database\Factories;

use App\Domains\Products\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true)
        ];
    }
}
