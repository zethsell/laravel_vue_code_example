<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

readonly class UserListService
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function execute(): array
    {
        return $this->repository->list();
    }
}

