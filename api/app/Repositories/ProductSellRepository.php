<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\ProductSell;

class ProductSellRepository extends BaseRepository
{
    public function getModel(): BaseModel
    {
        return new ProductSell();
    }

}
