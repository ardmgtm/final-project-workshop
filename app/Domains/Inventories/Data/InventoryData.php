<?php

namespace App\Domains\Inventories\Data;

use App\Http\Requests\InventoryRequest;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class InventoryData extends Data
{
    public function __construct(
        public int $product_id,
        public int $stock,
    ) {}

    public static function fromRequest(InventoryRequest $request): self
    {
        return new self(
            product_id: $request->product_id,
            stock: $request->stock,
        );
    }
}
