<?php

namespace App\Providers;

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ConfigController;
use Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
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
        if(hasTables(['announcements']))
        {
            $announcementArray = Cache::remember('announcementArray', 600, function () {
                return AnnouncementController::announcements();
            });
            view()->share('announcementArray', $announcementArray);
        }
        if(hasTables(['configs']))
        {
            $configsArray = Cache::remember('configsArray', 180, function () {
                return ConfigController::configs();
            });
            view()->share('configsArray', $configsArray);
        }
        if(hasTables([
            'announcements','categories','configs','error_logs','faq','orders',
            'payment_methods','service_updates','services','tickets','users'
        ]))
        {
            view()->composer('pages.admin.layout', 'App\Http\View\AdminMenuCountsComposer');
        }
    }
}
