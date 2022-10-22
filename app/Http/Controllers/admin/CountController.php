<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountController extends Controller
{
    public array $count;

    public function countAll(){
        foreach(get_class_methods($this) as $class){
            if($class != 'countAll' && Str::startsWith($class, 'count')){
               $this->$class();
            }
        }
        return $this->count;
    }
}
