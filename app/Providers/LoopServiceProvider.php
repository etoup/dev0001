<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LoopServiceProvider extends ServiceProvider
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
            \App\Repositories\Backend\Loop\LoopsRepositoryContract::class,
            \App\Repositories\Backend\Loop\EloquentLoopsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Backend\Loop\Tags\LoopTagsRepositoryContract::class,
            \App\Repositories\Backend\Loop\Tags\EloquentLoopTagsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Backend\Loop\Authority\LoopAuthorityRepositoryContract::class,
            \App\Repositories\Backend\Loop\Authority\EloquentLoopAuthorityRepository::class
        );
        $this->app->bind(
            \App\Repositories\Open\Loops\LoopsRepositoryContract::class,
            \App\Repositories\Open\Loops\EloquentLoopsRepository::class
        );
    }
}
