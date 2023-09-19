<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\helpers\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserLoggedController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {
            $result = Auth::user();
            return HttpResponse::ok($result);
        } catch (\Throwable $error) {
            return HttpResponse::badRequest($error);
        }
    }


}
