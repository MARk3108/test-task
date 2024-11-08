<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarBrandModelRequest;
use App\Services\CarBrandModelService;
use App\Models\CarBrand;
use App\Models\CarBrandModel;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CarBrandModelResource;

class CarBrandModelController extends Controller
{
    public function __construct(private CarBrandModelService $service){}

    public function index(CarBrand $carBrand): JsonResponse
    {
        $models = $this->service->getAll($carBrand->id);
        return response()->json(CarBrandModelResource::collection($models));
    }

    public function store(CarBrandModelRequest $request, CarBrand $carBrand): JsonResponse
    {
        $data = $request->validated();
        $data['car_brand_id'] = $carBrand->id;      
        $carBrandModel = $this->service->create($data);
        return response()->json(new CarBrandModelResource($carBrandModel), 201);
    }

    public function update(CarBrandModelRequest $request, CarBrand $carBrand, CarBrandModel $carBrandModel): JsonResponse
    {
        if(!$carBrandModel->hasModel($carBrand)) {
            return response()->json(['error' => 'This model does not belong to the given brand'], 400);
        }
        $this->service->update($carBrandModel, $request->validated());
        return response()->json($carBrandModel);
    }

    public function destroy(CarBrand $carBrand, CarBrandModel $carBrandModel): JsonResponse
    {
        if(!$carBrandModel->hasModel($carBrand)) {
            return response()->json(['error' => 'This model does not belong to the given brand'], 400);
        }
        $this->service->delete($carBrandModel);
        return response()->json(null, 204);
    }
}