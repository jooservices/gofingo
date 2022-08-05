<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\Traits\CrudService;

class CategoryService
{
    use CrudService;

    public function __construct(protected CategoryRepository $repository)
    {
    }
}
