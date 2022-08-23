<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public static function configs(){
        $config = new Config();
        $configs = $config->all();
        $configsArray = [];
        foreach($configs as $config){
            $configsArray[$config->name] = $config->value;
        }
        return $configsArray;
    }
}
