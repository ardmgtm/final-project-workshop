<?php

namespace Tests\Feature;

use App\Domains\Orders\Actions\CreateOrderAction;
use App\Domains\Orders\Models\Order;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Mockery;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_returns_order()
    {
        // Arrange: Create a mock order
        $order = Order::factory()->create();

        // Act: Retrieve the order
        $response = $this->getJson(route('orders.get', $order));

        // Assert: Check the response
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($order->id, $response['data']['id']);
    }

    public function test_store_creates_order()
    {
        // Arrange: Create a mock product
        $product = Product::factory()->create();

        // Mock the StoreOrderRequest
        $requestData = [
            'product_id' => $product->id,
            'quantity' => 5,
        ];

        // Mock the CreateOrderAction
        $mockCreateOrderAction = Mockery::mock(CreateOrderAction::class);
        $mockOrderData = [
            'id' => 1,
            'product_id' => $product->id,
            'quantity' => 5,
        ];

        $mockCreateOrderAction->shouldReceive('execute')
            ->with($product, $requestData['quantity'])
            ->once()
            ->andReturn($mockOrderData);

        // Bind the mock action to the container
        $this->app->instance(CreateOrderAction::class, $mockCreateOrderAction);

        // Act: Post the request to create an order
        $response = $this->postJson(route('orders.store'), $requestData);

        // Assert: Check the response and database
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals($mockOrderData, $response['data']);
    }

    public function test_store_returns_error_on_exception()
    {
        // Arrange: Create a mock product
        $product = Product::factory()->create();

        // Mock the StoreOrderRequest
        $requestData = [
            'product_id' => $product->id,
            'quantity' => 5,
        ];

        // Mock the CreateOrderAction to throw an exception
        $mockCreateOrderAction = Mockery::mock(CreateOrderAction::class);
        $mockCreateOrderAction->shouldReceive('execute')
            ->andThrow(new \Exception('Insufficient stock'));

        // Bind the mock action to the container
        $this->app->instance(CreateOrderAction::class, $mockCreateOrderAction);

        // Act: Post the request
        $response = $this->postJson(route('orders.store'), $requestData);

        // Assert: Check the response contains errors
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(['quantity' => 'Insufficient stock'], $response['errors']);
    }
}
