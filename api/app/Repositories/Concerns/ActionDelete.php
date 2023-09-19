<?php

namespace App\Repositories\Concerns;


use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;


trait ActionDelete
{
    public function deleteResource(BaseModel $resource)
    {
        return DB::transaction(function () use ($resource) {
            $resource = $this->onBeforeDelete($resource);
            $resource->delete();
            return $this->onAfterDelete($resource);
        });

    }

    public function deleteFromField($value, $field = null): void
    {
        $this->model->where($field, $value)->delete();
    }

    public function deleteMany(array $resourcesIds): void
    {
        DB::transaction(function () use ($resourcesIds) {
            foreach ($resourcesIds as $resourceId) {
                $resource = $this->model->find($resourceId);

                if (empty($resource)) {
                    continue;
                }

                $resource->delete();
            }
        });
    }


    public function deleteMultiplesByFieldAndKey(array $keyWhere, $field, array $values, $condition = 'in'): void
    {
        DB::transaction(function () use ($field, $keyWhere, $condition, $values) {
            if ($condition == 'in') {
                $this->model->where($keyWhere)->whereIn($field, $values)->delete();
            }
            if ($condition == 'not-in') {
                $this->model->where($keyWhere)->whereNotIn($field, $values)->delete();
            }
        });
    }

    public function onBeforeDelete(BaseModel $resource): BaseModel
    {
        return $resource;
    }

    public function deleteByConditions(array $conditions): void
    {
        $this->getModel()->where(function ($query) use ($conditions) {
            foreach ($conditions as $key => $condition) {
                $query->where($key, $condition);
            }
        })->delete();
    }
}
