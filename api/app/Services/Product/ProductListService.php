<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;

readonly class ProductListService
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function execute(): array
    {
        return $this->repository->list();
    }
}

