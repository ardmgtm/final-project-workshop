<?php

namespace App\Domains\Products\Data;

use App\Http\Requests\ProductRequest;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProductData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
    ) {}

    public static function fromRequest(ProductRequest $request): self
    {
        return new self(
            name: $request->name,
            description: $request->description,
            price: $request->price,
        );
    }
}
