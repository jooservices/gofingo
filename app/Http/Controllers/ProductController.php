<?php

namespace App\Http\Controllers;

use App\Core\Controllers\Traits\UseCrud;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController
{

    use UseCrud;

    public function __construct(protected ProductService $service)
    {
    }

    public function create(CreateProductRequest $request)
    {
        return new ProductResource($this->_create($request->toArray()));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $model = $this->_update($product, $request->toArray());

        return new ProductResource($model);
    }

    public function delete(Product $product)
    {
        return $this->_delete($product);
    }

    public function index()
    {
        return ProductResource::collection($this->_index());
    }
}
