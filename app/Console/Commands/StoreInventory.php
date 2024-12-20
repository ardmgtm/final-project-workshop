<?php

namespace App\Console\Commands;

use App\Domains\Products\Actions\CreateInventoryAction;
use App\Domains\Products\Models\Product;
use Illuminate\Console\Command;

class StoreInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-inventory
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
    public function handle(CreateInventoryAction $createInventory)
    {
        try {
            $product = Product::findOrFail($this->argument('product_id'));
            $createInventory->execute($product,$this->argument('quantity'));
            $this->info("inventory for product '{$product->name}' has been created successfully!");
            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return 0;
        }
    }
}
