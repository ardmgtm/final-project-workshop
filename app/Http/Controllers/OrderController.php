<?php

namespace App\Http\Controllers;

use App\Domains\Orders\Data\OrderData;
use App\Domains\Orders\Services\OrderService;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    public function index()
    {
        return $this->orderService->get();
    }

    public function store(OrderRequest $request)
    {
        return $this->orderService->store(OrderData::fromRequest($request));
    }
}
