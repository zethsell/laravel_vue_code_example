<?php

namespace App\Services\Auth;

use App\DTOs\Auth\SignInDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

readonly class SignInService
{
    public function __construct(private UserRepository $repository)
    {

    }

    public function execute(SignInDTO $data): array
    {
        if (!Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            throw new \Error('Invalid credentials!', 401);
        }

        $user = $this->repository->getModel()
            ->whereId(Auth::user()->id)
            ->first();

        $user->tokens()->delete();

        $accessToken = $user->createToken('auth_token')->plainTextToken;
        return compact('accessToken');
    }
}

