<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Inventory;

class DecreaseProductQuantityAction
{
    public function execute(int $productId, int $quantity): void
    {
        $inventory = Inventory::where('product_id', $productId)->first();
        if ($inventory) {
            $inventory = $inventory->update([
                'product_id' => $productId,
                'quantity' => $inventory->quantity - $quantity,
            ]);
        }
    }
}
