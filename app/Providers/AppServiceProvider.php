<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //temporary force https for local as well
        if ($this->app->environment('local')) {
            \URL::forceScheme('https');
        }
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
