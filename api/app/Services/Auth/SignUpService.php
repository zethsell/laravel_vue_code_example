<?php

namespace App\Services\Auth;

use App\DTOs\Auth\SignUpDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

readonly class SignUpService
{
    public function __construct(private UserRepository $repository)
    {

    }

    public function execute(SignUpDTO $data): void
    {
        $this->repository->store([
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'name' => $data->name,
        ]);
    }
}

