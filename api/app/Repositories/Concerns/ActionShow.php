<?php

namespace App\Repositories\Concerns;

trait ActionShow
{
    public function showByConditions($conditions = [])
    {
        return $this->model->where(function ($query) use ($conditions) {
            foreach ($conditions as $key => $condition) {
                $query->where($key, $condition);
            }
        })->first();
    }

}
