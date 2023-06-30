<?php

namespace App\Http\Filters;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Request;

class TicketIndexFilter extends RequestFilter
{
    public function default()
    {
        $this->status($this->additionalParams->status);
        return $this->builder->where('user_id', auth()->user()->id)->orderByDesc('created_at');
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
