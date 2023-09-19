<?php

namespace App\Repositories\Concerns;


use App\Models\BaseModel;
use Illuminate\Contracts\Auth\Authenticatable;

trait ActionOrder
{
    public function orderBy($column, $direction = 'asc'): BaseModel|Authenticatable
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this->model;
    }

    public function order($data): BaseModel
    {
        $exists = preg_grep('/^order_*/i', array_keys($data));
        if ($exists) {
            foreach ($data as $key => $value) {
                if (!str_contains($key, "order_")) {
                    continue;
                }
                $orderDirection = str_replace("order_", "", $key);
                $this->model = $this->model->orderBy($value, $orderDirection);
            }
        }
        return $this->model;
    }
}
