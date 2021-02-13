<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\User;
use App\Observers\PropertyObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Property::observe(PropertyObserver::class);
//        AnnualPerformance::observe(AnnualPerformanceObserver::class);
    }
}
