<?php

namespace App\Http\Controllers;

use App\Domains\Inventories\Data\InventoryData;
use App\Domains\Inventories\Services\InventoryService;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function __construct(
        private readonly InventoryService $inventoryService
    ) {}

    public function index()
    {
        return $this->inventoryService->get();
    }

    public function store(InventoryRequest $request): Inventory
    {
        return $this->inventoryService->store(InventoryData::fromRequest($request));
    }
}
