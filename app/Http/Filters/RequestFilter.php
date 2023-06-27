<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Fluent;

abstract class RequestFilter
{
    protected $additionalParams;
    public function default(){}

    public function filterByFunctions(Builder $builder, $additionalParams): Builder
    {
        $this->builder = $builder;
        $this->additionalParams = new Fluent($additionalParams);
        $this->default();

        foreach(request()->all() as $name => $value) {
            if(method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }
        return $this->builder;
    }
}
