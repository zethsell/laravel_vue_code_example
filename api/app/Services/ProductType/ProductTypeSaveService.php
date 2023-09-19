<?php

namespace App\Services\ProductType;

use App\DTOs\ProductTypeSaveDTO;
use App\Models\BaseModel;
use App\Models\ProductType;
use App\Repositories\ProductTypeRepository;
use Illuminate\Support\Arr;

readonly class ProductTypeSaveService
{
    public function __construct(private ProductTypeRepository $repository)
    {
    }

    public function execute(ProductTypeSaveDTO $data, ProductType $type = null): BaseModel|ProductType
    {
        $type = $this->repository->storeOrUpdate(
            ['id' => Arr::get($type, 'id', 0)],
            $data->toArray()
        );

        if (!isset($type->id)) {
            throw new  \Error('failed to store Product type');
        }

        $taxes = $data->taxes;
        $type->load('taxes');
        $type->taxes()->detach();
        $type->refresh();

        if (!empty($taxes)) {
            foreach ($taxes as $key => $tax) {
                $taxes[$key]['product_type_id'] = $type->id;
            }

            $this->repository->getModel()->taxes()->sync($taxes);
        }
        return $type;
    }
}

