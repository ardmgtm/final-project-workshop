<?php

namespace App\Domains\Products\Requests;

use App\Domains\Products\Requests\ApiFormRequest;

class StoreInventoryRequest extends ApiFormRequest
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
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ];
    }
}
