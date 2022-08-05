<?php

namespace App\Http\Controllers;

use App\Core\Controllers\Traits\UseCrud;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController
{
    use UseCrud;

    public function __construct(protected CategoryService $service)
    {
    }

    public function create(CreateCategoryRequest $request)
    {
        return new CategoryResource($this->_create($request->toArray()));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $model = $this->_update($category, $request->toArray());

        return new CategoryResource($model);
    }

    public function delete(Category $category)
    {
        return $this->_delete($category);
    }

    public function index()
    {
        return CategoryResource::collection($this->_index());
    }
}
