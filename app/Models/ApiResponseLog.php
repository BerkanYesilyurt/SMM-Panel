<?php

namespace App\Models;

use App\Enums\ApiResponseTypesEnum;
use Illuminate\Database\Eloquent\Model;
use Str;

class ApiResponseLog extends Model
{
    protected $table = 'api_response_logs';
    protected $guarded = ['id'];

    public function getResponseAttribute($value)
    {
        return Str::isJson($value) ? json_decode($value) : $value;
    }

    public function api()
    {
        return $this->belongsTo(Api::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
