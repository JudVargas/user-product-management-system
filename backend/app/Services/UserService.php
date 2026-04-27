<?php

namespace App\Services;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {   
        try {
            return $this->repository->getAll();
        }
        catch (\Exception $e) {
            throw new \Exception('Error al obtener los usuarios: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            return $this->repository->findById($id);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al obtener el usuario: ' . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            $data['name'] = trim($data['name']);
            $data['email'] = strtolower($data['email']);
            $data['password'] = Hash::make($data['password']);
            return $this->repository->create($data);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try{
            
            if (isset($data['password'])) {
                $user = $this->repository->findById($id);
                $data['password'] = Hash::make($data['password']);
            }
            return $this->repository->update($user, $data);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al actualizar el usuario: ' . $e->getMessage());
        }

    }

    public function delete($id)
    {
        try {
            $user = $this->repository->findById($id);
            return $this->repository->delete($user);
        }
        catch (\Exception $e) {
            throw new \Exception('Error al eliminar el usuario: ' . $e->getMessage());
        }
    }

};