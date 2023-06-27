<?php

namespace App\Http\Filters;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Request;

class TicketIndexFilter extends RequestFilter
{
    public function default()
    {
        return $this->builder->where('user_id', auth()->user()->id)->orderByDesc('created_at');
    }

}
