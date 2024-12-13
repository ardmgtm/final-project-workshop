<?php

namespace App\Domains\Products\Commands;

use Illuminate\Console\Command;
use App\Domains\Products\Models\Product;

class StoreProduct extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'product:store
    {category_id : The name of the product}
    {name : The name of the product}
    {description : The description of the product}
    {price : The price of the product}';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Store a new product into the database';

    /**
    * Execute the console command.
    */
    public function handle()
    {
        // Retrieve input arguments
        $category_id = $this->argument('category_id');
        $name = $this->argument('name');
        $description = $this->argument('description') ?? 'No description provided';
        $price = $this->argument('price');

        // Validate price
        if (!is_numeric($price) || $price <= 0) {
            $this->error('The price must be a positive number.');
            return 1; // Exit with error
        }

        // Create a new product
        $product = Product::create([
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);

        $this->info("Product '{$product->name}' has been created successfully!");

        return 0; // Exit with success
    }
}
