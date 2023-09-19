<?php

namespace App\Services\Product;

use App\DTOs\ProductSaveDTO;
use App\Models\BaseModel;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Arr;

readonly class ProductSaveService
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function execute(ProductSaveDTO $data, Product $type = null): BaseModel|Product
    {
        return $this->repository->storeOrUpdate(
            ['id' => Arr::get($type, 'id', 0)],
            [
                "description" => $data->description,
                "value" => $data->value,
                "type_id" => $data->typeId
            ]
        );
    }
}

