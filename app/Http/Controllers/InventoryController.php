<?php

namespace App\Http\Controllers;

use App\Domains\Products\Actions\CreateInventoryAction;
use App\Domains\Products\Models\Product;
use App\Http\Requests\StoreInventoryRequest;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    public function store(StoreInventoryRequest $request, CreateInventoryAction $createInventory)
    {
        $inventoryData = $createInventory->execute(
            Product::findOrFail($request->getProductId()),
            $request->getQuantity(),
        );

        return response([
            'data' => $inventoryData,
        ], Response::HTTP_CREATED);
    }
}
