<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Products\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create();
    }
}
