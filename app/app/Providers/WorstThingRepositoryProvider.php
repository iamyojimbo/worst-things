<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WorstThingRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // All repos are singletons for performance and testability
        $this->app->singleton('App\Repositories\Interfaces\WorstThingRepositoryInterface', 'App\Repositories\Postgres\WorstThingRepository');
    }
}
