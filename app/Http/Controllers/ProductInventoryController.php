<?php

namespace App\Http\Controllers;

use App\Domains\Products\Models\Inventory;
use App\Domains\Products\Models\Product;
use App\Domains\Products\Requests\GetProductInventoryRequest;

class ProductInventoryController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $inventories = Inventory::totalQuantities($products);

        return [
            'data' => $inventories,
        ];
    }
}
