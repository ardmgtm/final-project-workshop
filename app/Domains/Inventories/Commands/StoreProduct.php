<?php

namespace App\Domains\Products\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class StoreProduct extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'product:store
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
        try {
            // Retrieve input arguments
            $name = $this->argument('name');
            $description = $this->argument('description') ?? 'No description provided';
            $price = $this->argument('price');

            // Validate price
            if (!is_numeric($price) || $price <= 0) {
                $this->error('The price must be a positive number.');
                return 1; // Exit with error
            }

            // Validasi
            $validated = validator([
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ], [
                'name' => 'required|string|unique:products,name',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0.01',
            ])->validate();

            // Simpan produk
            $product = Product::create($validated);

            $this->info("Product '{$product->name}' has been created successfully!");

            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());

            return 0;
        }
    }
}
