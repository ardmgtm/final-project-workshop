<?php

namespace App\Http\Controllers;

use App\Domains\Products\Requests\StoreCategoryRequest;
use App\Domains\Products\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return [
            'data' => $categories,
        ];
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->getName(),
        ]);

        return [
            'data' => $category->toData(),
        ];
    }
}
