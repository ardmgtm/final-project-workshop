<?php

namespace App\Domains\Orders\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class StoreOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:store
    {product_id : The product_id of the order}
    {quantity : The quantity of the order}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store a new order into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Retrieve input arguments
            $product_id = $this->argument('product_id');
            $quantity = $this->argument('quantity');
            // Validate
            if (!is_numeric($product_id) || $product_id <= 0) {
                $this->error('The product_id must be a positive number.');
                return 1; // Exit with error
            }
            if (!is_numeric($quantity) || $quantity <= 0) {
                $this->error('The quantity must be a positive number.');
                return 1; // Exit with error
            }

            // Validasi
            $validated = validator([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ], [
                'product_id' => 'required|numeric|min:0.01',
                'quantity' => 'required|numeric|min:0.01',
            ])->validate();

            // Simpan produk
            $order = Order::create($validated);

            $this->info("order '{$order->name}' has been created successfully!");

            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());

            return 0;
        }
    }
}
