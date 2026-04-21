<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseController;

Route::middleware(['web', 'auth:sanctum'])->group(function () {

    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);

    // Rutas para productos solo para administradores
    Route::middleware('role:admin')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
    Route::post('/purchase', [PurchaseController::class, 'purchase']);
    
});