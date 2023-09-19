<?php

namespace App\Services\Sell;

use App\Repositories\SellRepository;

readonly class SellListService
{
    public function __construct(private SellRepository $repository)
    {
    }

    public function execute(): array
    {
        return $this->repository->list();
    }
}

