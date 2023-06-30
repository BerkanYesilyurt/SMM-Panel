<?php

namespace App\Http\Filters\admin;

use App\Enums\TicketStatusEnum;
use App\Http\Filters\RequestFilter;

class TicketIndexFilter extends RequestFilter
{
    public function default()
    {
        $this->status($this->additionalParams->status);
        return $this->builder->orderByDesc('created_at');
    }

    public function status($value)
    {
        if($value && $value != 'all'){
            $status = match ($value){
                'closed' => TicketStatusEnum::CLOSED->value,
                'active' => TicketStatusEnum::ACTIVE->value
            };
            return $this->builder->where('status', $status);
        }
    }
}
