<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Inventory;

class DecreaseProductQuantityAction
{
    public function execute(int $product_id, int $quantity): void
    {
        $inventory = Inventory::where(['product_id',$product_id])->first();
        if($inventory){
            $inventory = $inventory->update([
                'product_id' => $product_id,
                'quantity' => $quantity + $quantity,
            ]);
        }
    }
}
