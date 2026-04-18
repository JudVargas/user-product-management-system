<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['web', 'auth:sanctum'])->group(function () {

});

