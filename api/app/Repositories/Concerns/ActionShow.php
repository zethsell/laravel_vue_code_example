<?php

namespace App\Repositories\Concerns;

use App\Models\BaseModel;

trait ActionShow
{
    public function showByConditions($conditions = []): ?BaseModel
    {
        return $this->model->where(function ($query) use ($conditions) {
            foreach ($conditions as $key => $condition) {
                $query->where($key, $condition);
            }
        })->first();
    }

}
