<?php

namespace Adaptdk\PimApi;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PimApiServiceProvider extends ServiceProvider
{
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
