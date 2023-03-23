<?php

namespace App\Services;

use App\Models\Api;
use App\Models\ApiResponseLog;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class SendOrder
{
    public function __construct(public Order $order, public Api $api){}

    public function sendOrder(): void
    {
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

            if($response->successful()){
                $this->createApiResponseLog($response->body());
            }else{
                $this->createApiResponseLog('ERROR: ' . $response->body());
            }
        }catch (\Exception $e){
            $this->createApiResponseLog('ERROR: ' . $e->getMessage());
        }
    }

    private function createApiResponseLog($response): void
    {
        ApiResponseLog::create([
            'order_id' => $this->order->id,
            'api_id' => $this->order->api_provider_id,
            'response' => $response
        ]);
    }
}
