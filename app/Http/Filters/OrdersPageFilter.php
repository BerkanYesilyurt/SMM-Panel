<?php

namespace App\Http\Filters;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Request;

class OrdersPageFilter extends RequestFilter
{
    public function default()
    {
        $this->status($this->additionalParams->status);
        return $this->builder->orderByDesc('created_at');
    }

    public function search($value)
    {
        return $this->builder->whereId($value)
            ->orWhere('link', 'LIKE', '%'.$value.'%')
            ->orWhereHas('user', function ($query) use ($value){
                $query->where('email', 'LIKE', '%'.$value.'%');
            })
            ->orWhereHas('service', function ($query) use ($value){
                $query->where('name', 'LIKE', '%'.$value.'%');
            });
    }

    public function status($value)
    {
        if($value && $value != 'all' && in_array($value, OrderStatusEnum::getOnlyNames(true)->toArray())){
            $status = match ($value){
                'pending' => OrderStatusEnum::PENDING->value,
                'processing' => OrderStatusEnum::PROCESSING->value,
                'inprogress' => OrderStatusEnum::INPROGRESS->value,
                'completed' => OrderStatusEnum::COMPLETED->value,
                'partial' => OrderStatusEnum::PARTIAL->value,
                'canceled' => OrderStatusEnum::CANCELED->value,
            };
            return $this->builder->where('status', $status);
        }
    }
}
