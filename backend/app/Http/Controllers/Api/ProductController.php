<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        return response()->json([
            'success' => true,
            'data' => $this->service->list()
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $product
        ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->get($id)
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->service->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado'
        ]);
    }

}
