<?php

namespace App\Providers;


use App\Http\Controllers\ConfigController;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configsArray = ConfigController::configs();
        view()->share('configsArray', $configsArray);
    }
}
