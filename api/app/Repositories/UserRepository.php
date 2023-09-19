<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRepository extends BaseRepository
{
    public function getModel(): Authenticatable
    {
        return new User();
    }

    public function list(): array
    {
        return $this->getModel()
            ->orderBy('name', 'ASC')
            ->get(['id', 'name', 'email', 'created_at', 'updated_at'])
            ->toArray();
    }

}
