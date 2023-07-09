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
        $this->additionalParams = $additionalParams ? new Fluent($additionalParams) : NULL;
        $this->default();

        foreach(request()->all() as $name => $value) {
            if(method_exists($this, $name) && $this->checkIfParamIsExcept($name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }
        return $this->builder;
    }

    public function checkIfParamIsExcept($name): bool
    {
        return !($this->additionalParams->excepts && in_array($name, (array)$this->additionalParams->excepts));
    }
}
