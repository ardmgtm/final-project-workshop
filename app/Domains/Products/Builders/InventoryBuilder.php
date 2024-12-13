<?php

namespace App\Domains\Products\Builders;

use App\Domains\Products\Models\Inventory;
use App\Domains\Products\Models\Product;
use Ecommerce\Common\DataTransferObjects\Warehouse\InventoryData;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class InventoryBuilder extends Builder
{
    /**
     * @param Collection<Product> $products
     * @return Collection<InventoryData>
     */
    public function totalQuantities(Collection $products): Collection
    {
        return $products
            ->mapWithKeys(fn (Product $product) => [
                $product->id => self::totalQuantity($product),
            ])
            ->values();
    }

    public function totalQuantity(Product $product): float
    {
        return Inventory::select('quantity')
            ->where('product_id', $product->id)
            ->sum('quantity');
    }
}
