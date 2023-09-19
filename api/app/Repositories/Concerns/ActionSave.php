<?php

namespace App\Repositories\Concerns;

use App\Models\BaseModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;


trait ActionSave
{
    public function make(array $attributes): BaseModel|Authenticatable
    {
        $resource = new $this->model;
        return $resource->fill($attributes);
    }

    public function makeConditional(array $conditional, array $attributes): BaseModel|Authenticatable
    {
        $resource = $this->model->where($conditional)->first();
        if (!$resource) {
            $resource = new $this->model;
        }
        return $resource->fill($attributes);
    }

    public function onBeforeStore(array $attributes): array
    {
        return $attributes;
    }

    public function save(BaseModel|Authenticatable $resource): BaseModel|Authenticatable
    {
        $resource->save();
        return $resource;
    }

    public function store(array $attributes): BaseModel|Authenticatable
    {
        return DB::transaction(function () use ($attributes) {
            $attributes = $this->onBeforeStore($attributes);
            $resource = $this->make($attributes);
            $resource = $this->save($resource);
            $resource->refresh();
            return $resource;
        });
    }

    public function storeOrUpdate(array $conditional, array $attributes = []): BaseModel|Authenticatable
    {
        return DB::transaction(function () use ($conditional, $attributes) {
            $attributes = $this->onBeforeStore($attributes);
            $resource = $this->makeConditional($conditional, $attributes);
            $resource = $this->save($resource);
            $resource->refresh();
            return $resource;
        });
    }

    public function updateResource(BaseModel $resource, array $attributes): BaseModel|Authenticatable
    {
        return DB::transaction(function () use ($resource, $attributes) {
            $resource->fill($attributes);
            $resource->save();
            $resource->refresh();
            return $resource;
        });
    }
}
