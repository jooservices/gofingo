<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Model;

trait CrudService
{
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(Model $model, array $data)
    {
        return $this->repository->setModel($model)->update($data);
    }

    public function delete(Model $model)
    {
        return $this->repository->setModel($model)->delete();
    }

    public function index()
    {
        return $this->repository->index();
    }
}
