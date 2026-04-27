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
        try {
            return $this->repository->getAll();
        }
        catch (\Exception $e) {
            throw new \Exception('Error al obtener los productos: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            return $this->repository->findById($id);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al obtener el producto: ' . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            $data['name'] = trim($data['name']);
            $data['description'] = trim($data['description']);
            $data['price'] = floatval($data['price']);
            $data['stock'] = intval($data['stock']);
            return $this->repository->create($data);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al crear el producto: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            $data['name'] = trim($data['name']);
            $data['description'] = trim($data['description']);
            $data['price'] = floatval($data['price']);
            $data['stock'] = intval($data['stock']);
            $product = $this->repository->findById($id);
            return $this->repository->update($product, $data);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product = $this->repository->findById($id);
            return $this->repository->delete($product);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}

