<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Request;

abstract class RequestFilter
{
    public function __construct(protected Request $request){}

    public function filterByFunctions(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach($this->request->all() as $name => $value) {
            if(method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }
        return $this->builder;
    }
}
