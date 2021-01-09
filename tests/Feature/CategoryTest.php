<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** store */
    public function testCreateShouldReturnErrorOnInvalidParams()
    {
        $data = [
            'name' => ''
        ];

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(422)
        ->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    'The name field is required.'
                ],
            ],
        ]);
    }

    public function testCreateShouldReturnErrorOnUniqueSlug()
    {
        $data = [
            'name' => 'Sembako',
        ];

        Category::create($data);

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(422);
    }

    public function testCreateShouldReturnHttpCreatedOnSuccess()
    {
        $data = [
            'name' => 'Sembako',
        ];

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
            ],
        ]);
    }
    /** end store */

    /** update */
    public function testUpdateShouldReturnErrorOnUniqueSlug()
    {
        $data = [
            'name' => 'Sembako',
        ];

        Category::create($data);

        $data = [
            'name' => 'Test',
        ];

        $categoryTwo = Category::create($data);

        $response = $this->putJson('/api/categories/'. $categoryTwo->slug, [
            'name' => 'Sembako',
        ]);

        $response->assertStatus(422)
        ->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    'The name has already been taken.',
                ],
            ],
        ]);
    }

    public function testUpdateShouldReturnHttpOkOnSuccess()
    {
        $data = [
            'name' => 'Sembako',
        ];

        $category = Category::create($data);

        $data = [
            'name' => 'Test',
        ];

        $response = $this->putJson('/api/categories/'. $category->slug, $data);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
            ],
        ]);
    }
    /** end update */

    /** fetch */
    public function testNoCategoriesShouldReturnNoContent()
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(204);
    }

    public function testNoCategoryShouldReturnNotFound()
    {
        $response = $this->getJson('/api/categories/test');

        $response->assertStatus(404);
    }

    public function testGetAllShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Sembako',
        ];

        Category::create($data);

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
    }

    public function testGetSingleShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Sembako',
        ];

        $category = Category::create($data);

        $response = $this->getJson('/api/categories/'. $category->slug);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'name' => $category->name,
                'slug' => $category->slug,
            ],
        ]);
    }
    /** end fetch */

    /** destroy */
    public function testDestroyShouldReturnHttpNotFoundIfNotFound()
    {
        $data = [
            'name' => 'Sembako',
        ];

        Category::create($data);

        $response = $this->deleteJson('/api/categories/test');

        $response->assertStatus(404);
    }

    public function testDestroyShouldReturnHttpOkOnSuccess()
    {
        $data = [
            'name' => 'Sembako',
        ];

        $category = Category::create($data);

        $response = $this->deleteJson('/api/categories/'. $category->slug);

        $response->assertStatus(200)
        ->assertJson([
            'message' => 'success',
        ]);
    }
}
