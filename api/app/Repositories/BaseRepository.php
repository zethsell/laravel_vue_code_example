<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Repositories\Concerns\ActionDelete;
use App\Repositories\Concerns\ActionSave;
use App\Repositories\Concerns\ActionShow;
use Illuminate\Foundation\Auth\User as Authenticatable;


abstract class BaseRepository
{
    use ActionDelete,
        ActionShow,
        ActionSave;

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract public function getModel(): BaseModel|Authenticatable;

}
