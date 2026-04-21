<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->getAll();
    }

    public function get($id)
    {
        return $this->repository->findById($id);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        $product = $this->repository->findById($id);
        return $this->repository->update($product, $data);
    }

    public function delete($id)
    {
        $product = $this->repository->findById($id);
        return $this->repository->delete($product);
    }
}

