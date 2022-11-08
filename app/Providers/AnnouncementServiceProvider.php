<?php

namespace App\Providers;

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AnnouncementServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('announcements'))
        {
            $announcementArray = AnnouncementController::announcements();
            view()->share('announcementArray', $announcementArray);
        }
    }
}
