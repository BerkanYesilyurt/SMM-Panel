<?php

namespace App\Services;

use App\Enums\ApiResponseTypesEnum;
use App\Models\Api;
use Illuminate\Support\Facades\Http;

class CheckApiBalance
{
    public function __construct(public Api $api){}

    public function checkApiBalance()
    {
        $type = ApiResponseTypesEnum::APIBALANCE->value;
        try{
            // TODO: withoutVerifying() will be deleted
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->connectTimeout(15)
                ->post($this->api->url, [
                    'key' => $this->api->key,
                    'action' => $this->api->balance_action
                ]);

            // TODO: $response->object()->balance will be replaced with API response matches
            if($response->successful() && isset($response->object()->balance)){
                createApiResponseLog(null, $this->api->id, $type, $response->body());
            }else{
                createApiResponseLog(null, $this->api->id, $type, $response->body(), true);
            }
        }catch (\Exception $e){
            createApiResponseLog(null, $this->api->id, $type, $e->getMessage(), true);
        }
    }
}
