<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use App\Models\CarBrandModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarBrandModelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_models_for_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        CarBrandModel::create(['title' => 'Granta', 'car_brand_id' => $carBrand->id]);
        CarBrandModel::create(['title' => 'Priora', 'car_brand_id' => $carBrand->id]);

        $response = $this->get("/api/car-brands/{$carBrand->id}/models");

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function test_store_creates_new_model_for_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);

        $response = $this->post("/api/car-brands/{$carBrand->id}/models", ['title' => 'Granta']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('car_brand_models', [
            'title' => 'Granta',
            'car_brand_id' => $carBrand->id
        ]);
    }

    public function test_update_modifies_existing_model(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        $carBrandModel = CarBrandModel::create(['title' => 'Granta', 'car_brand_id' => $carBrand->id]);

        $response = $this->put("/api/car-brands/{$carBrand->id}/models/{$carBrandModel->id}", [
            'title' => 'Granta sport'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('car_brand_models', ['title' => 'Granta sport']);
    }

    public function test_destroy_deletes_model(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        $carBrandModel = CarBrandModel::create(['title' => 'Priora', 'car_brand_id' => $carBrand->id]);

        $response = $this->delete("/api/car-brands/{$carBrand->id}/models/{$carBrandModel->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('car_brand_models', ['title' => 'Priora']);
    }
}
