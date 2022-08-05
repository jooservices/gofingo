<?php

namespace App\Repositories;

use App\Repositories\Traits\CrudRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    use CrudRepository;

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(Model $model)
    {
        return $this->model;
    }
}
