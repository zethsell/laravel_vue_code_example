<?php

namespace App\Http\Controllers;

use App\DTOs\ProductSaveDTO;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Product\ProductListService;
use App\Services\Product\ProductSaveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductListService $listService,
        private readonly ProductSaveService $saveService
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

    public function store(ProductStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new ProductSaveDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function show(Product $product): JsonResponse
    {
        try {
            return HttpResponse::ok($product);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new ProductSaveDTO($request->validated()), $product);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function destroy(Product $product): Response|JsonResponse
    {
        try {
            $product->delete();
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
