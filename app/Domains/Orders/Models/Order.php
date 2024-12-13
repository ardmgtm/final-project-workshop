<?php

namespace App\Domains\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\OrderData;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function toData(): OrderData
    // {
    //     return new OrderData(
    //         $this->product_id,
    //         $this->quantity,
    //         $this->total_price
    //     );
    // }
}
