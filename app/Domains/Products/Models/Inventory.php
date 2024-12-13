<?php

namespace App\Domains\Products\Models;

use App\Domains\Products\Builders\InventoryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function newEloquentBuilder($query)
    {
        return new InventoryBuilder($query);
    }
}
