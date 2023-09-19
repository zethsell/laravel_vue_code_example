<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getModel(): BaseModel
    {
        return new Product();
    }

    public function list(): array
    {
        return $this->getModel()
            ->orderBy('description', 'ASC')
            ->with('productType', function ($type) {
                $type->with('taxes');
            })
            ->get()
            ->toArray();
    }

}
