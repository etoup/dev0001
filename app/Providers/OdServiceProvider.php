<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OdServiceProvider extends ServiceProvider
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
        $this->app->bind(
            \App\Repositories\Backend\Od\OrdersRepositoryContract::class,
            \App\Repositories\Backend\Od\EloquentOrdersRepository::class
        );
    }
}
