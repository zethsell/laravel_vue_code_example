<?php

namespace App\Http\Controllers;

use App\DTOs\ProductTypeSaveDTO;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\ProductType\ProductTypeStoreRequest;
use App\Http\Requests\ProductType\ProductTypeUpdateRequest;
use App\Models\ProductType;
use App\Services\ProductType\ProductTypeListService;
use App\Services\ProductType\ProductTypeSaveService;
use App\Services\ProductType\ProductTypeShowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductTypeController extends Controller
{
    public function __construct(
        private readonly ProductTypeListService $listService,
        private readonly ProductTypeSaveService $saveService,
        private readonly ProductTypeShowService $showService,
    )
    {
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->listService->execute();
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function store(ProductTypeStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new ProductTypeSaveDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function show(ProductType $productType): JsonResponse
    {
        try {
            $result = $this->showService->execute($productType->id);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function update(ProductTypeUpdateRequest $request, ProductType $productType): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new ProductTypeSaveDTO($request->validated()), $productType);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function destroy(ProductType $productType): Response|JsonResponse
    {
        try {
            $productType->delete();
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
