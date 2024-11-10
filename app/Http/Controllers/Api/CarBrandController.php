<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarBrandRequest;
use App\Services\CarBrandService;
use App\Models\CarBrand;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CarBrandResource;

class CarBrandController extends Controller
{

    public function __construct(private CarBrandService $service) {}

    public function index(CarBrandRequest $request): JsonResponse
    {
        \Log::info($request);
        \Log::info($request->input('title'));
        $carBrands = $this->service->getAll($request->input('title'));
        return response()->json(CarBrandResource::collection($carBrands));
    }

    public function store(CarBrandRequest $request): JsonResponse
    {
        $carBrand = $this->service->create($request->validated());
        return response()->json($carBrand, 201);
    }

    public function update(CarBrandRequest $request, CarBrand $carBrand): JsonResponse
    {
        $this->service->update($carBrand, $request->validated());
        return response()->json($carBrand);
    }

    public function destroy(CarBrand $carBrand): JsonResponse
    {
        $this->service->delete($carBrand);
        return response()->json(null, 204);
    }
}