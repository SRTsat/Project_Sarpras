<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') !== 'production') {
            // Aktifin hanya saat dipakai oleh Flutter / LAN
            if (request()->is('api/*')) {
                URL::forceRootUrl(config('app.url'));
            }
        }
    }
}
