<?php

namespace App\Domains\Orders\Actions;

use App\Exceptions\ProductInventoryExceededException;
use App\Domains\Orders\Models\Order;
use App\Domains\Products\Models\Product;
use App\Domains\Orders\Services\OrderService;

class CreateOrderAction
{
    // public function __construct(
    //     private readonly OrderService $orderService,
    //     private readonly RedisService $redis,
    // ) {}

    /**
     * @throws ProductInventoryExceededException
     */
    public function execute(Product $product, float $quantity): Order
    {
        // if ($quantity > $this->warehouseService->getTotalInventory($product)) {
        //     throw new Throwable(
        //         "There is not enough $product->name in inventory"
        //     );
        // }

        $order = Order::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
        ]);

        // $this->redis->publishOrderCreated($order->toData());

        return $order;
    }
}
