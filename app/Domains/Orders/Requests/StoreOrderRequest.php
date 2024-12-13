<?php

namespace App\Domains\Orders\Requests;

class StoreOrderRequest extends ApiFormRequest
{
    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function rules()
    {
        return [
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
        ];
    }
}
