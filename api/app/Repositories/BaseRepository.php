<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Repositories\Concerns\ActionDelete;
use App\Repositories\Concerns\ActionOrder;
use App\Repositories\Concerns\ActionShow;
use App\Repositories\Concerns\ActionStore;
use App\Repositories\Concerns\ActionUpdate;
use Illuminate\Foundation\Auth\User as Authenticatable;


abstract class BaseRepository
{
    use ActionDelete,
        ActionShow,
        ActionOrder,
        ActionUpdate,
        ActionStore;

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract public function getModel(): BaseModel|Authenticatable;

}
