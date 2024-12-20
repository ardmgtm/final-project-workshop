<?php

namespace Tests\Domains\Products\Actions;

use App\Domains\Products\Actions\CreateProductAction;
use App\Domains\Products\Models\Category;
use App\Domains\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(CreateProductAction::class)]
#[CoversClass(Category::class)]
#[CoversClass(Product::class)]
class CreateProductActionTest extends TestCase
{
    use RefreshDatabase;

    public function it_creates_a_product()
    {
        // Arrange: Create a category
        $category = Category::factory()->create();

        // Action: Execute the CreateProductAction
        $action = new CreateProductAction();
        $product = $action->execute($category, 'Test Product', 'This is a test product', 99.99);

        // Assert: Check that the product was created successfully
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('This is a test product', $product->description);
        $this->assertEquals(99.99, $product->price);
        $this->assertEquals($category->id, $product->category_id);
    }
}
