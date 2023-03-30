<?php

namespace App\Services;

use App\Enums\ApiResponseTypesEnum;
use App\Events\OrderStatus;
use App\Models\Api;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class SendOrder
{
    public function __construct(public Order $order, public Api $api){}

    public function sendOrder(): void
    {
        $type = ApiResponseTypesEnum::ORDER->value;
        try{
            // TODO: withoutVerifying() will be deleted
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->connectTimeout(15)
                ->post($this->api->url, [
                    'key' => $this->api->key,
                    'action' => $this->api->add_action,
                    $this->api->service_key => $this->order->api_service_id,
                    $this->api->link_key => $this->order->link,
                    $this->api->quantity_key => $this->order->quantity
                ]);

            // TODO: $response->object()->order will be replaced with API response matches
            if($response->successful() && isset($response->object()->order)){
                createApiResponseLog($this->order->id, $type, $this->order->api_provider_id, $response->body());
                event(new OrderStatus($this->order));
            }else{
                createApiResponseLog($this->order->id, $type, $this->order->api_provider_id, $response->body(), true);
            }
        }catch (\Exception $e){
            createApiResponseLog($this->order->id, $type, $this->order->api_provider_id, $e->getMessage(), true);
        }
    }
}
