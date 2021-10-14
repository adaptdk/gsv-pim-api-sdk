<?php

namespace Adaptdk\PimApi;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PimApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the config values
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'gsv-pim-api');
    }
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/routes/api.php');
    }
}
