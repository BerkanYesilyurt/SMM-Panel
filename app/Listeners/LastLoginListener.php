<?php

namespace App\Listeners;

use App\Events\LastLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class LastLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LastLogin  $event
     * @return void
     */
    public function handle(LastLogin $event)
    {
        $event->user->last_login = Carbon::now();
        $event->user->last_login_ip = $event->ip;
        $event->user->save();
    }
}
