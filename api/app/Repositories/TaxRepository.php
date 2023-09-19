<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Tax;

class TaxRepository extends BaseRepository
{
    public function getModel(): BaseModel
    {
        return new Tax();
    }

    public function list(): array
    {
        return $this->getModel()->orderBy('description', 'ASC')
            ->get()
            ->toArray();
    }

}
