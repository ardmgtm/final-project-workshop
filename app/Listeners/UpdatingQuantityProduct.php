<?php

namespace App\Listeners;

use App\Domains\Inventories\Services\InventoryService;
use App\Events\OrderCreated;

class UpdatingStockListener
{
    public function __construct(
        private readonly InventoryService $inventoryService
    ) {}

    public function handle(OrderCreated $event): void
    {
        $this->inventoryService->updatingStock($event->orderData);
    }
}
