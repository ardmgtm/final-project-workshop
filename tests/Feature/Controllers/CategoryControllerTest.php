<?php

namespace Tests\Feature;

use App\Domains\Products\Models\Category;
use App\Domains\Products\Requests\StoreCategoryRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_index_returns_categories()
    {
        // Arrange: Create some categories
        Category::factory()->count(3)->create();

        // Act: Call the index method
        $response = $this->getJson(route('categories.index'));

        // Assert: Check the response status and data
        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(3, $response['data']);
    }

    public function test_store_creates_category()
    {
        // Arrange: Prepare mock data for category
        $categoryData = [
            'name' => $this->faker->word,
        ];

        // Act: Post the request to create a new category
        $response = $this->postJson(route('categories.store'), $categoryData);

        // Assert: Check the response status and that the category was created
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($categoryData['name'], $response['data']['name']);
        $this->assertDatabaseHas('categories', [
            'name' => $categoryData['name'],
        ]);
    }
}