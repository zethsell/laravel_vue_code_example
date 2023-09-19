<?php

namespace App\Services\ProductType;

use App\Models\BaseModel;
use App\Models\ProductType;
use App\Repositories\ProductTypeRepository;

readonly class ProductTypeShowService
{
    public function __construct(private ProductTypeRepository $repository)
    {
    }

    public function execute(int $id): BaseModel|ProductType
    {
        return $this->repository->show($id);
    }
}

