<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function setModel(Model $model);

    public function getModel(Model $model);

    public function create(array $data = []);

    public function find(int $id);

    public function update(array $data);

    public function delete();

    public function index();
}
