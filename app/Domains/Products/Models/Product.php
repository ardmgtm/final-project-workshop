<?php

namespace App\Domains\Products\Models;

use App\Domains\Products\Builders\ProductBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceFormattedAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }
}
