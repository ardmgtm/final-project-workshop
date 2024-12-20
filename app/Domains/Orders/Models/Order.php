<?php

namespace App\Domains\Orders\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected static function newFactory()
    {
        return OrderFactory::new();
    }
}
