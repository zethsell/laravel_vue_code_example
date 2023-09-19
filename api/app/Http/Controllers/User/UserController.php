<?php

namespace App\Http\Controllers\User;

use App\DTOs\UserSaveDTO;
use App\Http\Controllers\Controller;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\User\UserListService;
use App\Services\User\UserSaveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct(
        private readonly UserListService $listService,
        private readonly UserSaveService $saveService,
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


    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new UserSaveDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function show(User $user): JsonResponse
    {
        try {
            return HttpResponse::ok($user);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }


    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        try {
            $result = $this->saveService->execute(new UserSaveDTO($request->validated()), $user);
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }

    public function destroy(User $user): Response|JsonResponse
    {
        try {
            $user->delete();
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
