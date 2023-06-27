<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use App\Http\Filters\RequestFilter as Filter;

abstract class Model extends EloquentModel
{
    /**
     * @param Builder $query
     * @param Filter $filter
     * @return Builder
     */
    public function scopeFilterByFunctions(Builder $query, Filter $filter, $additionalParams = NULL): Builder
    {
        return $filter->filterByFunctions($query, $additionalParams);
    }
}
