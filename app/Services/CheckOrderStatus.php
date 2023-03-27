<?php

namespace App\Services;

use App\Models\Api;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class CheckOrderStatus
{
    public function __construct(public Order $order, public Api $api){}

    public function checkOrderStatus(): void
    {
        try{
            // TODO: withoutVerifying() will be deleted
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->connectTimeout(15)
                ->post($this->api->url, [
                    'key' => $this->api->key,
                    'action' => $this->api->status_action,
                    $this->api->order_key => $this->order->api_order_id
                ]);

            // TODO: $response->object()->status will be replaced with API response matches
            if($response->successful() && isset($response->object()->status)){
                createApiResponseLog($this->order->id, $this->order->api_provider_id, $response->body());
            }else{
                createApiResponseLog($this->order->id, $this->order->api_provider_id, $response->body(), true);
            }
        }catch (\Exception $e){
            createApiResponseLog($this->order->id, $this->order->api_provider_id, $e->getMessage(), true);
        }
    }
}
