<?php

namespace App\Traits;

use Schema;

trait FilterTrait {

    public function scopeFilter($builder, $requests = [])
    {

        if(!$requests) {
            return $builder;
        }

        $columns = array_diff(Schema::getColumnListing($this->getTable()), $this->guarded);
        foreach ($requests as $field => $value){
            if(!$value || !in_array($field, $columns)){
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
