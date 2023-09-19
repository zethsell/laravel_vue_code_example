<?php

namespace App\Services\User;

use App\DTOs\UserSaveDTO;
use App\Models\BaseModel;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

readonly class UserSaveService
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function execute(UserSaveDTO $data, User $user = null): BaseModel|User
    {
        if ($data->password !== null) {
            $user['password'] = Hash::make($data->password);
        }

        return $this->repository->storeOrUpdate(
            ['id' => Arr::get($user, 'id', 0)],
            [
                'email' => $data->email,
                'password' => $user['password'],
                'name' => $data->name,
            ]
        );
    }
}

