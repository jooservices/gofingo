<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\Traits\CrudService;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    use CrudService {
        create as parentCreate;
    }

    public function __construct(protected ProductRepository $repository)
    {
    }

    public function create(array $data): Model
    {
        $model = $this->parentCreate($data);

        if (isset($data['categoriesEid']))
        {
            $model->categories()->sync($data['categoriesEid']);
        }

        return $model;
    }
}
