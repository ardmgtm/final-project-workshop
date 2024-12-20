<?php

namespace Tests\Feature;

use App\Domains\Products\Actions\CreateInventoryAction;
use App\Domains\Products\Models\Inventory;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(CreateInventoryAction::class)]
class CreateInventoryActionTest extends TestCase
{
    use RefreshDatabase;

    public function it_creates_an_inventory_when_none_exists()
    {
        // Arrange
        $product = Product::factory()->create(); // Using model factory to create a product
        $quantity = 10;
        $action = new CreateInventoryAction();

        // Act
        $inventory = $action->execute($product, $quantity);

        // Assert
        $this->assertDatabaseHas('inventories', [
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
        $this->assertInstanceOf(Inventory::class, $inventory);
    }

    public function it_updates_an_existing_inventory()
    {
        // Arrange
        $product = Product::factory()->create();
        Inventory::create([
            'product_id' => $product->id,
            'quantity' => 5,
        ]);
        $additionalQuantity = 10;
        $action = new CreateInventoryAction();

        // Act
        $inventory = $action->execute($product, $additionalQuantity);

        // Assert
        $this->assertDatabaseHas('inventories', [
            'product_id' => $product->id,
            'quantity' => 15, // 5 existing + 10 new
        ]);
        $this->assertInstanceOf(Inventory::class, $inventory);
    }
}
