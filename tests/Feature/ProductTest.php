<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** store */
    public function testCreateShouldReturnErrorOnInvalidParams()
    {
        $data = [
            'name' => ''
        ];

        $response = $this->postJson('/api/products', $data);

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
            'name' => 'Drink Water',
        ];

        Product::create($data);

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(422);
    }

    public function testCreateShouldReturnHttpCreatedOnSuccess()
    {
        $data = [
            'name' => 'Drink Water',
        ];

        $response = $this->postJson('/api/products', $data);

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
            'name' => 'Drink Water',
        ];

        Product::create($data);

        $data = [
            'name' => 'Beer',
        ];

        $productTwo = Product::create($data);

        $response = $this->putJson('/api/products/'. $productTwo->slug, [
            'name' => 'Drink Water',
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
            'name' => 'Drink Water',
        ];

        $product = Product::create($data);

        $data = [
            'name' => 'Beer',
        ];

        $response = $this->putJson('/api/products/'. $product->slug, $data);

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
    public function testNoProductsShouldReturnNoContent()
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(204);
    }

    public function testNoProductShouldReturnNotFound()
    {
        $response = $this->getJson('/api/products/test');

        $response->assertStatus(404);
    }

    public function testGetAllShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Drink Water',
        ];

        Product::create($data);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200);
    }

    public function testGetSingleShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Drink Water',
        ];

        $product = Product::create($data);

        $response = $this->getJson('/api/products/'. $product->slug);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'name' => $product->name,
                'slug' => $product->slug,
            ],
        ]);
    }
    /** end fetch */

    /** destroy */
    public function testDestroyShouldReturnHttpNotFoundIfNotFound()
    {
        $data = [
            'name' => 'Drink Water',
        ];

        Product::create($data);

        $response = $this->deleteJson('/api/products/test');

        $response->assertStatus(404);
    }

    public function testDestroyShouldReturnHttpOkOnSuccess()
    {
        $data = [
            'name' => 'Drink Water',
        ];

        $product = Product::create($data);

        $response = $this->deleteJson('/api/products/'. $product->slug);

        $response->assertStatus(200)
        ->assertJson([
            'message' => 'success',
        ]);
    }
}
