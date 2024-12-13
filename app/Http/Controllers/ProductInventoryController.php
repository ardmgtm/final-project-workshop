<?php

namespace App\Http\Controllers;

use App\Domains\Products\Models\Inventory;
use App\Domains\Products\Models\Product;
use App\Http\Requests\GetProductInventoryRequest;

class ProductInventoryController extends Controller
{
    public function index(GetProductInventoryRequest $request)
    {
        $products = Product::find($request->getProductIds());

        $inventories = Inventory::totalQuantities($products);

        return [
            'data' => $inventories,
        ];
    }
}
