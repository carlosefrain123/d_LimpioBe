<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * La ruta a donde serán redirigidos los usuarios después de login/registro.
     */
    public const HOME = '/dashboard';  // 👈 Agregamos esto

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
