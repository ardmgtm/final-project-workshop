<?php

namespace App\Http\Controllers;

use App\Domains\Products\Actions\CreateProductAction;
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
            'data' => $products,
        ];
    }

    public function get(Product $product)
    {
        return ['data' => $product];
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
            'data' => $product
        ], Response::HTTP_CREATED);
    }
}
