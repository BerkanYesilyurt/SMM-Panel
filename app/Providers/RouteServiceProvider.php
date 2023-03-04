<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            $this->mapApiRoutes();
            $this->mapGuestRoutes();
            $this->mapUserRoutes();
            $this->mapAdminRoutes();
        });
    }

    protected function mapApiRoutes(){
        Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));
    }

    protected function mapGuestRoutes(){
        Route::middleware('web')->group(base_path('routes/guest.php'));
    }

    protected function mapUserRoutes(){
        Route::middleware(['web', 'auth', 'maintenance', 'verifypanelinstalled', 'isaccountbanned'])->group(base_path('routes/user.php'));
    }

    protected function mapAdminRoutes(){
        Route::middleware(['web', 'auth', 'isadmin', 'verifypanelinstalled'])->prefix('/admin/')->group(base_path('routes/admin.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
