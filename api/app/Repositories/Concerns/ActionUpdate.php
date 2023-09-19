<?php

namespace App\Repositories\Concerns;

use App\Models\BaseModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;


trait ActionUpdate
{
    public function updateResource(BaseModel $resource, array $attributes): BaseModel|Authenticatable
    {
        return DB::transaction(function () use ($resource, $attributes) {
            $attributes = $this->onBeforeUpdate($resource, $attributes);
            $resource->fill($attributes);
            $resource->save();
            $resource = $this->onAfterUpdate($resource, $attributes);
            $resource->refresh();
            return $resource;
        });
    }

    public function onBeforeUpdate(BaseModel $resource, array $attributes): array
    {
        return $attributes;
    }

    public function onAfterUpdate(BaseModel $resource, array $attributes): BaseModel
    {
        return $resource;
    }
}
