<?php

namespace App\Console\Commands;

use App\Domains\Orders\Actions\CreateOrderAction;
use App\Domains\Products\Models\Product;
use Illuminate\Console\Command;

class CreateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-order
    {product_id : id product}
    {quantity : quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CreateOrderAction $createOrder)
    {
        try {
            $product = Product::findOrFail($this->argument('product_id'));
            $createOrder->execute($product,$this->argument('quantity'));
            $this->info("Order for product '{$product->name}' has been created successfully!");
            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return 0;
        }
    }
}
