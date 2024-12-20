<?php

namespace Tests\Feature;

use App\Domains\Products\Actions\DecreaseProductQuantityAction;
use App\Domains\Products\Models\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(DecreaseProductQuantityAction::class)]
class DecreaseProductQuantityActionTest extends TestCase
{
    use RefreshDatabase; // Refresh the database for each test

    public function it_decreases_the_product_quantity_in_inventory()
    {
        // Arrange: Create a product with an initial quantity
        $productId = 1;
        Inventory::create(['product_id' => $productId, 'quantity' => 10]);

        // Act: Decrease the product quantity
        $action = new DecreaseProductQuantityAction();
        $action->execute($productId, 3);

        // Assert: Check the inventory quantity is decreased accurately
        $inventory = Inventory::where('product_id', $productId)->first();
        $this->assertNotNull($inventory);
        $this->assertEquals(7, $inventory->quantity); // 10 - 3
    }

    public function it_does_not_decrease_the_quantity_below_zero()
    {
        // Arrange: Create a product with a quantity of 2
        $productId = 2;
        Inventory::create(['product_id' => $productId, 'quantity' => 2]);

        // Act: Try to decrease the quantity beyond available stock
        $action = new DecreaseProductQuantityAction();
        $action->execute($productId, 3);

        // Assert: The inventory quantity should not be below zero
        $inventory = Inventory::where('product_id', $productId)->first();
        $this->assertNotNull($inventory);
        $this->assertEquals(2, $inventory->quantity); // Should not change
    }
}
