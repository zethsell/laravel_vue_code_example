<?php

namespace App\Services\Tax;

use App\Repositories\TaxRepository;

readonly class TaxListService
{
    public function __construct(private TaxRepository $repository)
    {
    }

    public function execute(): array
    {
        return $this->repository->list();
    }
}

