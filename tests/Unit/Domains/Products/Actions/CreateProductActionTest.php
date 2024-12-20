<?php

namespace Tests\Domains\Products\Actions;

use App\Domains\Products\Actions\CreateProductAction;
use App\Domains\Products\Models\Category;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(CreateProductAction::class)]
class CreateProductActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_execute_creates_product()
    {
        // Arrange
        $category = Category::factory()->create();
        $name = 'Test Product';
        $description = 'This is a test product.';
        $price = 29.99;

        // Creating a mock for CreateProductAction
        $action = $this->createMock(CreateProductAction::class);
        
        // Setting up the expectation for the execute method
        $action->expects($this->once())
               ->method('execute')
               ->with($category, $name, $description, $price)
               ->willReturn(new Product([
                   'category_id' => $category->id,
                   'name' => $name,
                   'description' => $description,
                   'price' => $price,
               ]));

        // Act
        $product = $action->execute($category, $name, $description, $price);

        // Assert
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($category->id, $product->category_id);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($price, $product->price);
    }
}
