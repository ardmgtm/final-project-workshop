<?php

namespace App\Domains\Orders\Actions;

use App\Exceptions\ProductInventoryExceededException;
use App\Domains\Orders\Models\Order;
use App\Domains\Products\Models\Product;
use App\Events\OrderCreated;

class CreateOrderAction
{
    /**
     * @throws ProductInventoryExceededException
     */
    public function execute(Product $product, float $quantity): Order
    {
        $order = Order::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
        ]);

        event(new OrderCreated($order));

        return $order;
    }
}
