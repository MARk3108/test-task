<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use App\Models\CarBrandModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarBrandModelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_models_for_brand_with_filter(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        CarBrandModel::create(['title' => 'Granta', 'car_brand_id' => $carBrand->id]);
        CarBrandModel::create(['title' => 'Priora', 'car_brand_id' => $carBrand->id]);

        $response = $this->get("/api/car-brands/{$carBrand->id}/models?title=Granta");

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['title' => 'Granta']);
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

    public function test_update_modifies_existing_model_for_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        $carBrandModel = CarBrandModel::create(['title' => 'Granta', 'car_brand_id' => $carBrand->id]);

        $response = $this->put("/api/car-brands/{$carBrand->id}/models/{$carBrandModel->id}", [
            'title' => 'Granta Sport'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('car_brand_models', ['title' => 'Granta Sport']);
    }

    public function test_update_fails_for_model_not_belonging_to_brand(): void
    {
        $carBrand1 = CarBrand::create(['title' => 'Lada']);
        $carBrand2 = CarBrand::create(['title' => 'Toyota']);
        $carBrandModel = CarBrandModel::create(['title' => 'Camry', 'car_brand_id' => $carBrand2->id]);

        $response = $this->put("/api/car-brands/{$carBrand1->id}/models/{$carBrandModel->id}", [
            'title' => 'Camry Sport'
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'This model does not belong to the given brand']);
    }

    public function test_destroy_deletes_model_for_brand(): void
    {
        $carBrand = CarBrand::create(['title' => 'Lada']);
        $carBrandModel = CarBrandModel::create(['title' => 'Priora', 'car_brand_id' => $carBrand->id]);

        $response = $this->delete("/api/car-brands/{$carBrand->id}/models/{$carBrandModel->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('car_brand_models', ['title' => 'Priora']);
    }

    public function test_store_allows_same_model_for_different_brands(): void
    {
        $carBrand1 = CarBrand::create(['title' => 'Lada']);
        $carBrand2 = CarBrand::create(['title' => 'Toyota']);

        $response1 = $this->post("/api/car-brands/{$carBrand1->id}/models", ['title' => 'Granta']);
        $response1->assertStatus(201);
        $this->assertDatabaseHas('car_brand_models', [
            'title' => 'Granta',
            'car_brand_id' => $carBrand1->id
        ]);
        $response2 = $this->post("/api/car-brands/{$carBrand2->id}/models", ['title' => 'Granta']);
        $response2->assertStatus(201);
        $this->assertDatabaseHas('car_brand_models', [
            'title' => 'Granta',
            'car_brand_id' => $carBrand2->id
        ]);
    }
}
