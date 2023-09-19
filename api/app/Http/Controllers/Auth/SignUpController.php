<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\SignUpDTO;
use App\Http\Controllers\Controller;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\Auth\SignUpRequest;
use App\Services\Auth\SignUpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SignUpController extends Controller
{

    public function __construct(private readonly SignUpService $service)
    {

    }

    public function __invoke(SignUpRequest $request): JsonResponse|Response
    {
        try {
            $this->service->execute(new SignUpDTO($request->validated()));
            return HttpResponse::noContent();
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }
}
