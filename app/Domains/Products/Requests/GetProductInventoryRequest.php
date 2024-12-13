<?php

namespace App\Domains\Products\Requests;

use App\Domains\Products\Requests\ApiFormRequest;

class GetProductInventoryRequest extends ApiFormRequest
{
    /**
     * @return int[]
     */
    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function rules()
    {
        return [
            'productIds' => 'required|array'
        ];
    }
}
