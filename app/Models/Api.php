<?php

namespace App\Models;

use App\Enums\ApiResponseTypesEnum;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;

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
    use FilterTrait;
    protected $table = 'apis';
    protected $guarded = ['id'];
    protected array $boolFilterFields = [];
    protected array $stringFilterFields = [
        'name'
    ];

    public function lastBalance()
    {
        return $this->hasOne(ApiResponseLog::class, 'api_id', 'id')
            ->where('type', ApiResponseTypesEnum::APIBALANCE->value)
            ->latestOfMany();
    }
}
