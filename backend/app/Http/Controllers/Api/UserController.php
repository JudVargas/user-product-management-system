<?php

namespace App\Http\Controllers\Api;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->list());
    }

    public function show($id)
    {
        return response()->json($this->service->get($id));
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->create($request->validated());
        return response()->json($user, 201);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->service->update($id, $request->validated());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = $this->service->delete($id);
        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ]);
    }
}
