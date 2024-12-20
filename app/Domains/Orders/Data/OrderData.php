<?php

namespace App\Domains\Orders\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class OrderData extends Data
{
    public function __construct(
        public int $product_id,
        public int $quantity,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            product_id: $request->product_id,
            quantity: $request->quantity,
        );
    }
}
