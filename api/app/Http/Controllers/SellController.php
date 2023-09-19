<?php

namespace App\Http\Controllers;

use App\DTOs\SellSaveDTO;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\Sell\SellStoreRequest;
use App\Http\Requests\Sell\SellUpdateRequest;
use App\Models\Sell;
use App\Services\Sell\SellListService;
use App\Services\Sell\SellSaveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SellController extends Controller
{
    public function __construct(
        private readonly SellListService $listService,
        private readonly SellSaveService $saveService
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

    public function store(SellStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new SellSaveDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function show(Sell $sell): JsonResponse
    {
        try {
            return HttpResponse::ok($sell);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function update(SellUpdateRequest $request, Sell $sell): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new SellSaveDTO($request->validated()), $sell);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function destroy(Sell $sell): Response|JsonResponse
    {
        try {
            $sell->delete();
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
