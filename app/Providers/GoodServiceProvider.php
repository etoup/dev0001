<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoodServiceProvider extends ServiceProvider
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
            \App\Repositories\Backend\Good\GoodsRepositoryContract::class,
            \App\Repositories\Backend\Good\EloquentGoodsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Open\Goods\GoodsRepositoryContract::class,
            \App\Repositories\Open\Goods\EloquentGoodsRepository::class
        );
    }
}
