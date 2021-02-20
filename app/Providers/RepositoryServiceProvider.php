<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(
//            \App\Repositories\User\UserRepositoryInterface::class,
//            \App\Repositories\User\UserEloquentRepository::class
//        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('currentUser', Auth::check() ? Auth::user() : false);
        });
    }
}
