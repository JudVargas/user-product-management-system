<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;

class PurchaseController extends Controller
{
    protected $service;

    public function __construct(PurchaseService $service)
    {
        $this->service = $service;
    }

    public function purchase(PurchaseRequest $request)
    {
     $order = $this->service->purchase(auth()->user(), $request->validated());
     return response()->json([
            'message' => 'Purchase successful',
            'order' => $order,
     ], 201);
     
    }
}
