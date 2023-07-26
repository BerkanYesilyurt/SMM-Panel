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

    public function type($value)
    {
        if($value == 'deleted'){
            return $this->builder->withTrashed();
        }else{
            return $this->builder->whereHas('is_banned', function ($query) use ($value) {
                $query->where('type', $value)
                    ->where(function ($q){
                        $q->where('permanent', true)
                            ->orWhere('until_at', '>=', now());
                    });
            });
        }
    }
}
