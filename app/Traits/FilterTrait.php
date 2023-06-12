<?php

namespace App\Traits;

trait FilterTrait {

    public function scopeFilter($builder, $requests = [])
    {

        if(!$requests) {
            return $builder;
        }

        foreach ($requests as $field => $value){

            if(!$value || !in_array($field, $this->fillable)){
                continue;
            }

            if(in_array($field, $this->boolFilterFields) && $value != null) {
                $builder->where($field, (bool)$value);
                continue;
            }

            if(is_array($value)){
                $builder->whereIn($field, $value);
            }elseif(in_array($field, $this->stringFilterFields)){
                $builder->where($this->getTable().'.'.$field, 'LIKE', "%$value%");
            }else{
                $builder->where($field, $value);
            }

        }
        return $builder;
    }
}
