<?php

namespace App\Providers;

use App\Events\LastLogin;
use App\Events\OrderPlaced;
use App\Events\OrderStatus;
use App\Listeners\LastLoginListener;
use App\Listeners\OrderPlacedListener;
use App\Listeners\OrderStatusListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LastLogin::class => [
            LastLoginListener::class,
        ],
        OrderPlaced::class => [
            OrderPlacedListener::class,
        ],
        OrderStatus::class => [
            OrderStatusListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
