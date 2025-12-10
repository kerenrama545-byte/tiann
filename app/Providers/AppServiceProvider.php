<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Footer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('footer', Footer::first());
        });
    }
}
