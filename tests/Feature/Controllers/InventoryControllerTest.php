<?php

namespace Tests\Feature;

use App\Domains\Products\Actions\CreateInventoryAction;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class InventoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_inventory()
    {
        // Arrange: Create a mock product
        $product = new Product(['id'=>1]);

        // Create mock data for the inventory request
        $requestData = [
            'productId' => $product->id,
            'quantity' => 10,
        ];

        // Mock the CreateInventoryAction
        $mockCreateInventoryAction = Mockery::mock(CreateInventoryAction::class);
        $mockInventoryData = [
            'id' => 1,
            'productId' => $product->id,
            'quantity' => 10,
        ];

        $mockCreateInventoryAction->shouldReceive('execute')
            ->with($product, $requestData['quantity'])
            ->once()
            ->andReturn($mockInventoryData);

        // Bind the mock action
        $this->app->instance(CreateInventoryAction::class, $mockCreateInventoryAction);

        // Act: Post the request
        $response = $this->postJson(route('inventories.store'), $requestData);

        echo $response;

        // Assert
        // $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals($mockInventoryData, $response['data']);
    }
}
