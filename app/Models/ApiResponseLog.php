<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

/**
 * App\Models\ApiResponseLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApiResponseLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiResponseLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiResponseLog query()
 * @mixin \Eloquent
 */

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
