<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Api;
use App\Services\SendOrder;

class OrderPlacedListener
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
     * @param  \App\Events\OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {

        $order = $event->order;
        $api = Api::where('id', $event->order->api_provider_id)->first();

        (new SendOrder($order, $api))->sendOrder();
    }
}
