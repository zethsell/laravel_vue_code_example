<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\SignInDTO;
use App\Http\Controllers\Controller;
use App\Http\helpers\HttpResponse;
use App\Http\Requests\Auth\SignInRequest;
use App\Services\Auth\SignInService;

class SignInController extends Controller
{
    public function __construct(private readonly SignInService $service)
    {

    }

    public function __invoke(SignInRequest $request)
    {
        try {
            $result = $this->service->execute(new SignInDTO($request->validated()));
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::unauthorized($error);
        }
    }
}
