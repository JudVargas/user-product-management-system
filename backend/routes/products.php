<?php

use Illuminate\Support\Facades\Route;

Route::prefix('products')->middleware(['web', 'auth:sanctum'])->group(function () {

});