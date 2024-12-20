<?php

namespace Tests\Domains\Orders\Actions;

use App\Domains\Orders\Actions\CreateOrderAction;
use App\Domains\Orders\Models\Order;
use App\Domains\Products\Models\Product;
use App\Events\OrderCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(CreateOrderAction::class)]
class CreateOrderActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_execute_creates_order()
    {
        // Arrange
        $product = new Product();
        $product->id = 1;
        $product->price = 100;
        
        $quantity = 2;

        // Event Firing
        Event::fake(); // Prevent actual events from being dispatched.

        // Act
        $action = new CreateOrderAction();
        $order = $action->execute($product, $quantity);

        // Assert
        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($product->id, $order->product_id);
        $this->assertEquals($quantity, $order->quantity);
        $this->assertEquals($product->price * $quantity, $order->total_price);
        
        // Check that the event was dispatched
        Event::assertDispatched(OrderCreated::class);
    }
}
