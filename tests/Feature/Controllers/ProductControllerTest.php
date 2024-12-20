<?php

namespace Tests\Feature;

use App\Domains\Products\Models\Category;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_products()
    {
        // Arrange
        Product::factory()->count(3)->create();

        // Act
        $response = $this->getJson(route('products.index'));

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(3, $response['data']);
    }

    public function test_get_returns_single_product()
    {
        // Arrange
        $product = Product::factory()->create();

        // Act
        $response = $this->getJson(route('products.get', $product));

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($product->id, $response['data']['id']);
    }

    public function test_store_creates_new_product()
    {
        // Arrange
        $category = Category::factory()->create();

        $data = [
            'categoryId' => $category->id,
            'name' => 'New Product',
            'description' => 'Product Description',
            'price' => 19.99
        ];

        // Act
        $response = $this->postJson(route('products.store'), $data);

        // Assert
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('products', [
            'name' => 'New Product',
            'description' => 'Product Description',
            'price' => 19.99,
            'category_id' => $category->id,
        ]);
    }
}
