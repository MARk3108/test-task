<?php
namespace App\Services;

use App\Models\CarBrand;
use Illuminate\Database\Eloquent\Collection;

class CarBrandService
{
    public function getAll(): Collection
    {
        return CarBrand::with('models')->get();
    }

    public function create(array $data): CarBrand
    {
        return CarBrand::create($data);
    }

   public function update(CarBrand $carBrand, array $data): bool
    {
        return $carBrand->update($data);
    }

    public function delete(CarBrand $carBrand): bool
    {
        return $carBrand->delete();
    }
}