<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('api')
            ->prefix('api/users')
            ->group(base_path('routes/users.php'));

        Route::middleware('api')
            ->prefix('api/products')
            ->group(base_path('routes/products.php'));

        Route::middleware('api')
            ->prefix('api/auth')
            ->group(base_path('routes/auth.php'));
    }
}
