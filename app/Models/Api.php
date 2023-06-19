<?php

namespace App\Models;

use App\Enums\ApiResponseTypesEnum;
use App\Database\Model;

/**
 * App\Models\Api
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Api newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Api newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Api query()
 * @mixin \Eloquent
 */

class Api extends Model
{
    protected $table = 'apis';
    protected $guarded = ['id'];

    public function lastBalance()
    {
        return $this->hasOne(ApiResponseLog::class, 'api_id', 'id')
            ->where('type', ApiResponseTypesEnum::APIBALANCE->value)
            ->latestOfMany();
    }
}
