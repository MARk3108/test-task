<?php
namespace App\Services;

use App\Models\CarBrandModel;
use Illuminate\Database\Eloquent\Collection;

class CarBrandModelService extends TitleFilterService
{
    public function getAll(int $carBrandId, ?string $title = null): Collection
    {
        $query = CarBrandModel::query()->where('car_brand_id', $carBrandId);
        $query = $this->applyTitleFilter($query, $title); 
        return $query->get();
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