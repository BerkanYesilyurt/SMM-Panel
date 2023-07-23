<?php

namespace App\Http\Filters;

class UsersPageFilter extends RequestFilter
{
    public function orderby($value)
    {
        $explodedValue = explode('_', $value);
        if(in_array($explodedValue[1], ['id', 'balance'])){
            return $this->builder->orderBy($explodedValue[1], $explodedValue[0]);
        }
    }

    public function search($value)
    {
        return $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%'.$value.'%')
                ->orWhere('email', 'LIKE', '%'.$value.'%')
                ->orWhere('contact', 'LIKE', '%'.$value.'%');
        });
    }
}
