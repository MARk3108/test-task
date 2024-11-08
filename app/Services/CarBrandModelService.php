<?php
namespace App\Services;

use App\Models\CarBrandModel;
use Illuminate\Database\Eloquent\Collection;

class CarBrandModelService
{
    public function getAll(int $carBrandId): Collection
    {
        return CarBrandModel::where('car_brand_id', $carBrandId)->get();
    }

    public function create(array $data): CarBrandModel
    {
        return CarBrandModel::create($data);
    }

    public function update(CarBrandModel $carBrandModel, array $data): bool
    {
        return $carBrandModel->update($data);
    }

    public function delete(CarBrandModel $carBrandModel): bool
    {
        return $carBrandModel->delete();
    }
}