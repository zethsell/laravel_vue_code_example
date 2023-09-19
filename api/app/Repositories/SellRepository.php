<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Sell;

class SellRepository extends BaseRepository
{
    public function getModel(): BaseModel
    {
        return new Sell();
    }

    public function list(): array
    {
        return $this->getModel()->with(['details' => function ($details) {
            $details->with(['product' => function ($product) {
                $product->select(['id', 'description']);
            }]);
        }])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }

}
