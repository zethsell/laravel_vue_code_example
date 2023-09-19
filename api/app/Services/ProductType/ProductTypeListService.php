<?php

namespace App\Services\ProductType;

use App\Repositories\ProductTypeRepository;

readonly class ProductTypeListService
{
    public function __construct(private ProductTypeRepository $repository)
    {
    }

    public function execute(): array
    {
        return $this->repository->list();
    }
}

