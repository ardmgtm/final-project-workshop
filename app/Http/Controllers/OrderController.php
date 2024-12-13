<?php

namespace App\Http\Controllers;

use App\Domains\Orders\Actions\CreateOrderAction;
use App\Exceptions\ProductInventoryExceededException;
use App\Domains\Orders\Requests\StoreOrderRequest;
use App\Domains\Orders\Resources\OrderResource;
use App\Domains\Products\Models\Product;
use App\Domains\Orders\Models\Order;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function get(Order $order)
    {
        return ['data' => $order];
    }

    public function store(StoreOrderRequest $request, CreateOrderAction $createOrder)
    {
        try {
            $order = $createOrder->execute(
                Product::findOrFail($request->getProductId()),
                $request->getQuantity(),
            );

            return response([
                'data' => $order
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response([
                'errors' => ['quantity' => $th->getMessage()]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
