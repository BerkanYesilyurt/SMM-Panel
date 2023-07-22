<?php

namespace App\Http\Filters;

class UsersPageFilter extends RequestFilter
{
    public function search($value)
    {
        return $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%'.$value.'%')
                ->orWhere('email', 'LIKE', '%'.$value.'%')
                ->orWhere('contact', 'LIKE', '%'.$value.'%');
        });
    }
}
