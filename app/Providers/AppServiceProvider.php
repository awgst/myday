<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        //
        Blade::component('component.item', 'item');
        Blade::component('component.task', 'task');
        Blade::component('component.card', 'card');

        if(env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
