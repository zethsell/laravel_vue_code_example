<?php

namespace App\Services\Tax;

use App\DTOs\TaxSaveDTO;
use App\Models\BaseModel;
use App\Models\Tax;
use App\Repositories\TaxRepository;
use Illuminate\Support\Arr;

readonly class TaxSaveService
{
    public function __construct(private TaxRepository $repository)
    {
    }

    public function execute(TaxSaveDTO $data, Tax $tax = null): BaseModel|Tax
    {
        return $this->repository->storeOrUpdate(
            ['id' => Arr::get($tax, 'id', 0)],
            $data->toArray()
        );
    }
}

