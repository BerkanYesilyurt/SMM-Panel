<?php

namespace App\Listeners;

use App\Events\OrderStatus;

class OrderStatusListener
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
     * @param  \App\Events\OrderStatus  $event
     * @return void
     */
    public function handle(OrderStatus $event)
    {
        //
    }
}
