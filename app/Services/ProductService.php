<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    public $repository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }
}
