<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Request;

class OrdersPageFilter extends RequestFilter
{
    public function default()
    {
        return $this->builder->where('user_id', auth()->user()->id);
    }
    public function test($value)
    {
        return $this->builder->where('link', 'LIKE', "%$value%");
    }
}
