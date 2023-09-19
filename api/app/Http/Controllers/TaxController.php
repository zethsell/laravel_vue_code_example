<?php

namespace App\Http\Controllers;

use App\DTOs\TaxSaveDTO;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\Tax\TaxStoreRequest;
use App\Http\Requests\Tax\TaxUpdateRequest;
use App\Models\Tax;
use App\Services\Tax\TaxListService;
use App\Services\Tax\TaxSaveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaxController extends Controller
{
    public function __construct(
        private readonly TaxListService $listService,
        private readonly TaxSaveService $saveService
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

    public function store(TaxStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new TaxSaveDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function show(Tax $tax): JsonResponse
    {
        try {
            return HttpResponse::ok($tax);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function update(TaxUpdateRequest $request, Tax $tax): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new TaxSaveDTO($request->validated()), $tax);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function destroy(Tax $tax): Response|JsonResponse
    {
        try {
            $tax->delete();
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
