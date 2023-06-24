<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Request;

class OrdersPageFilter extends RequestFilter
{
    public function default()
    {
        return $this->builder->where('user_id', auth()->user()->id)->orderByDesc('created_at');
    }
    public function status($value)
    {
        if($value != 'all'){
            return $this->builder->where('status', $value);
        }
    }
}
