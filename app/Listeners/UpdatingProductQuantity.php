<?php

namespace App\Listeners;

use App\Domains\Products\Actions\DecreaseProductQuantityAction;
use App\Events\OrderCreated;

class UpdatingProductQuantity
{
    public function __construct(private DecreaseProductQuantityAction $decreaseProductQuantity) {}

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        $this->decreaseProductQuantity->execute(
            $order->product_id,
            $order->quantity,
        );
    }
}
