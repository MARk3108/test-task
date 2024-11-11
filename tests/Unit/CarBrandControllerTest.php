<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarBrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_brands_with_filter(): void
    {
        CarBrand::create(['title' => 'Mazda']);
        CarBrand::create(['title' => 'Lada']);

        $response = $this->get('/api/car-brands?title=Mazda');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['title' => 'Mazda']);
    }

    public function test_store_creates_new_brand(): void
    {
        $response = $this->post('/api/car-brands', ['title' => 'Lada']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('car_brands', ['title' => 'Lada']);
    }

    public function test_update_modifies_existing_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);

        $response = $this->put("/api/car-brands/{$carBrand->id}", ['title' => 'Lada updated']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('car_brands', ['title' => 'Lada updated']);
    }

    public function test_destroy_deletes_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);

        $response = $this->delete("/api/car-brands/{$carBrand->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('car_brands', ['title' => 'Lada']);
    }
}
