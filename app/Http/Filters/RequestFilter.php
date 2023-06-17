<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class RequestFilter
{
    public function default(){}
    
    public function filterByFunctions(Builder $builder): Builder
    {
        $this->builder = $builder;
        $this->default();

        foreach(request()->all() as $name => $value) {
            if(method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }
        return $this->builder;
    }
}
