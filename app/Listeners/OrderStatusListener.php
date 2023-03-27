<?php

namespace App\Listeners;

use App\Events\OrderStatus;
use App\Models\Api;
use App\Services\CheckOrderStatus;

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
        $order = $event->order;
        $api = Api::where('id', $event->order->api_provider_id)->first();
        (new CheckOrderStatus($order, $api))->checkOrderStatus();
    }
}
