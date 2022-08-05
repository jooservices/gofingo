<?php

namespace App\Repositories\Traits;

trait CrudRepository
{
    public function create(array $data = [])
    {
        $this->model = $this->model->create($data);

        return $this->model;
    }

    public function find(int $id)
    {
        $this->model = $this->model->find($id);

        return $this->model;
    }

    public function update(array $data)
    {
        $this->model->update($data);

        return $this->model;
    }

    public function delete()
    {
        $this->model->delete();

        return $this;
    }

    public function index()
    {
        return $this->model->newQuery()->get();
    }
}
