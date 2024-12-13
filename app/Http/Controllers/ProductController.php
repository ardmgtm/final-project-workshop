<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Domains\Products\Requests\GetProductsRequest;
use App\Domains\Products\Requests\StoreProductRequest;
use App\Domains\Products\Models\Category;
use App\Domains\Products\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(GetProductsRequest $request)
    {
        $products = Product::search(
            $request->getSearchTerm(),
            $request->getSortBy(),
            $request->getSortDirection(),
        );

        return [
            'data' => $products->map->toData(),
        ];
    }

    public function get(Product $product)
    {
        return ['data' => $product->toData()];
    }

    public function store(StoreProductRequest $request, CreateProductAction $createProduct)
    {
        $product = $createProduct->execute(
            Category::findOrFail($request->getCategoryId()),
            $request->getName(),
            $request->getDescription(),
            $request->getPrice()
        );

        return response([
            'data' => $product->toData()
        ], Response::HTTP_CREATED);
    }
}
