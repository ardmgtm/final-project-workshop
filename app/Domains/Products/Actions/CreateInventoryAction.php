<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Inventory;
use App\Domains\Products\Models\Product;

class CreateInventoryAction
{

    public function execute(Product $product, float $quantity): Inventory
    {
        $inventory = Inventory::where(['product_id',$product->id])->first();
        if($inventory){
            $inventory = $inventory->update([
                'product_id' => $product->id,
                'quantity' => $inventory->quantity + $quantity,
            ]);
        }else{
            $inventory = Inventory::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
        return $inventory;
    }
}
