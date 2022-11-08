<?php

namespace App\Providers;


use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('configs'))
        {
            $configsArray = ConfigController::configs();
            view()->share('configsArray', $configsArray);
        }
    }
}
