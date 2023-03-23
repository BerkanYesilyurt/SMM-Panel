<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Api;
use App\Models\ApiResponseLog;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

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

        try{
            // TODO: withoutVerifying() will be deleted
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->connectTimeout(15)
                ->post($api->url, [
                    'key' => $api->key,
                    'action' => $api->add_action,
                    $api->service_key => $order->api_service_id,
                    $api->link_key => $order->link,
                    $api->quantity_key => $order->quantity
                ]);

                ApiResponseLog::create([
                    'order_id' => $order->id,
                    'api_id' => $order->api_provider_id,
                    'response' => $response->successful() ? $response->body() : 'ERROR: ' . $response->body()
                ]);

        }catch (ConnectionException $e){
            ApiResponseLog::create([
                'order_id' => $order->id,
                'api_id' => $order->api_provider_id,
                'response' => 'ERROR: ' . $e->getMessage()
            ]);
        }
    }
}
