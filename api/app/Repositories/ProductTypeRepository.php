<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\ProductType;

class ProductTypeRepository extends BaseRepository
{
    public function getModel(): BaseModel
    {
        return new ProductType();
    }

    public function list(): array
    {
        return $this->getModel()->with('taxes')
            ->orderBy('description', 'ASC')
            ->get()
            ->toArray();
    }

    public function show($id): ?BaseModel
    {
        return $this->getModel()
            ->with('taxes')
            ->whereId($id)
            ->first();
    }

}
