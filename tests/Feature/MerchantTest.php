<?php

namespace Tests\Feature;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class MerchantTest extends TestCase
{
    use RefreshDatabase;

    /** store */
    public function testCreateShouldReturnErrorOnInvalidParams()
    {
        $data = [
            'name' => ''
        ];

        $response = $this->postJson('/api/merchants', $data);

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
            'name' => 'Toko',
        ];

        Merchant::create($data);

        $response = $this->postJson('/api/merchants', $data);

        $response->assertStatus(422);
    }

    public function testCreateShouldReturnHttpCreatedOnSuccess()
    {
        $data = [
            'name' => 'Toko',
        ];

        $response = $this->postJson('/api/merchants', $data);

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
            'name' => 'Toko',
        ];

        Merchant::create($data);

        $data = [
            'name' => 'Test',
        ];

        $MerchantTwo = Merchant::create($data);

        $response = $this->putJson('/api/merchants/'. $MerchantTwo->slug, [
            'name' => 'Toko',
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
            'name' => 'Toko',
        ];

        $Merchant = Merchant::create($data);

        $data = [
            'name' => 'Test',
        ];

        $response = $this->putJson('/api/merchants/'. $Merchant->slug, $data);

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
        $response = $this->getJson('/api/merchants');

        $response->assertStatus(204);
    }

    public function testNoMerchantShouldReturnNotFound()
    {
        $response = $this->getJson('/api/merchants/test');

        $response->assertStatus(404);
    }

    public function testGetAllShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Sembako',
        ];

        Merchant::create($data);

        $response = $this->getJson('/api/merchants');

        $response->assertStatus(200);
    }

    public function testGetSingleShouldReturnHttpOk()
    {
        $data = [
            'name' => 'Toko',
        ];

        $Merchant = Merchant::create($data);

        $response = $this->getJson('/api/merchants/'. $Merchant->slug);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'name' => $Merchant->name,
                'slug' => $Merchant->slug,
            ],
        ]);
    }
    /** end fetch */

    /** destroy */
    public function testDestroyShouldReturnHttpNotFoundIfNotFound()
    {
        $data = [
            'name' => 'Toko',
        ];

        Merchant::create($data);

        $response = $this->deleteJson('/api/merchants/test');

        $response->assertStatus(404);
    }

    public function testDestroyShouldReturnHttpOkOnSuccess()
    {
        $data = [
            'name' => 'Toko',
        ];

        $Merchant = Merchant::create($data);

        $response = $this->deleteJson('/api/merchants/'. $Merchant->slug);

        $response->assertStatus(200)
        ->assertJson([
            'message' => 'success',
        ]);
    }
}
