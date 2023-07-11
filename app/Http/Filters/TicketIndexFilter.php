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
        return $this->builder->orderByDesc('created_at');
    }

    public function search($value)
    {
        return $this->builder->where('id', $value)
            ->orwhere('order_id', $value)
            ->orWhere('pay_id', $value)
            ->orWhere('message', 'LIKE', '%'.$value.'%');
    }

    public function status($value)
    {
        if($value && $value != 'all' && in_array($value, TicketStatusEnum::getOnlyNames(true)->toArray())){
            $status = match ($value){
                'closed' => TicketStatusEnum::CLOSED->value,
                'active' => TicketStatusEnum::ACTIVE->value
            };
            return $this->builder->where('status', $status);
        }
    }
}
