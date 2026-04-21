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
        return $this->repository->getAll();
    }

    public function get($id)
    {
        return $this->repository->findById($id);
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        $user = $this->repository->findById($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository->update($user, $data);
    }

    public function delete($id)
    {
        $user = $this->repository->findById($id);
        return $this->repository->delete($user);
    }

};