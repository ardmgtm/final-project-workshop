<?php

namespace App\Domains\Products\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
